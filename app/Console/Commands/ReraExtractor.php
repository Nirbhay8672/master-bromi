<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Rera;
use App\Models\Taluka;
use App\Models\Village;
use Illuminate\Console\Command;

class ReraExtractor extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'rera';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */

	public function extract($url)
	{
		$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
		sleep(7);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		return $result;
	}

	public function handle()
	{
		$data = [];
		$district = 'Others';
		for ($i = 474; $i < 492; $i++) {
			$res = $this->extract('https://vlist.in/district/' . $i . '.html');
			if (str_contains($res, 'Taluka-wise list of census villages') && str_contains($res, 'Total Villages')) {
				$regex = '/Taluka-wise list of census villages in [a-zA-Z]+ district, Gujarat, India/i';
				if (preg_match_all($regex, $res, $matches)) {
					$district = $matches[0][0];
					$nn = str_replace('Taluka-wise list of census villages in', '', $district);
					$nn = str_replace('district, Gujarat, India', '', $nn);
					$nn1 = str_replace(' ', '', $nn);
					if (!isset($data[$nn1])) {
						$data[$nn1] = [];
					}
					$res = str_replace('/sub-district', 'https://vlist.in/sub-district', $res);
					$regex = '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#';
					if (preg_match_all($regex, $res, $matches)) {
						foreach ($matches[0] as $key => $value) {
							if (!str_contains($value, 'https://vlist.in/sub-district/')) {
								continue;
							}
							$res = $this->extract($value);
							if (str_contains($res, 'List of all villages') && str_contains($res, 'Village Code')) {
								$regex = '/Villages in [a-zA-Z]+ Taluka/i';
								if (preg_match_all($regex, $res, $matches)) {
									$taluka = $matches[0][0];
									$nn = str_replace('villages in', '', $taluka);
									$nn = str_replace('Taluka', '', $nn);
									$nn2 = str_replace(' ', '', $nn);
									$nn2 = str_replace('villagesin', '', $nn);
									if (!isset($data[$nn1][$nn2])) {
										$data[$nn1][$nn2] = [];
									}
									$res = str_replace('/village/', 'https://vlist.in/village/', $res);
									$regex = '#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#';
									preg_match_all($regex, $res, $matches);
									if (preg_match_all($regex, $res, $matches)) {
										foreach ($matches[0] as $key => $value) {
											if (!str_contains($value, 'https://vlist.in/village/') || count($data[$nn1][$nn2]) > 1) {
												continue;
											}
											$res = $this->extract($value);
											$regex = '/[a-zA-Z]+ on Google Map/i';
											if (preg_match_all($regex, $res, $matches)) {
												$village = $matches[0][0];
												$nn = str_replace('on Google Map', '', $village);
												$nn = str_replace(' ', '', $nn);
												$data[$nn1][$nn2][] = $nn;
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		foreach ($data as $key => $value) {
			$district = new District();
			$district->name = $key;
			$district->save();
			foreach ($value as $keys => $valuee) {
				$taluka = new Taluka();
				$taluka->district_id = $district->id;
				$taluka->name = $keys;
				$taluka->save();
				foreach ($valuee as $keyss => $valueee) {
					$village = new Village();
					$village->taluka_id = $taluka->id;
					$village->name = $valueee;
					$village->save();
				}
			}
		}
		// $district = 'Others';
		// $url = "https://gujrera.gujarat.gov.in/dashboard/get-district-wise-projectlist/0/0/all/" . $district . "/all";
		// $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($ch, CURLOPT_VERBOSE, false);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		// curl_setopt($ch, CURLOPT_URL, $url);
		// $result = curl_exec($ch);
		// $results = json_decode($result, true)['data'];
		// foreach ($results as $key => $value) {
		// 	$rera =  new Rera();
		// 	$rera->project_name = $value['projectName'];
		// 	$rera->promoter_name = $value['promoterName'];
		// 	$rera->reg_no = $value['regNo'];
		// 	$rera->district = $value['districtType'];
		// 	$rera->state = 'gujrat';
		// 	$rera->save();
		// }
	}
}
