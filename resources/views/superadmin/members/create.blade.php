@extends('admin.layouts.app')
@section('content')
<div class="app-main__outer">
	<div class="app-main__inner">
		<div class="app-page-title">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div class="page-title-icon">
						<i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
					</div>
					<div>
						New User
						<div class="page-title-subheading">
							<!-- Choose between regular React Bootstrap tables or advanced
							dynamic ones. -->
						</div>
					</div>
				</div>
				@if(isset($error))
				<div class="hidden" id="pageError" data-message="{{$error}}"></div>
				@endif
			</div>
		</div>
		<div class="main-card mb-3 card">
			<div class="card-body">
				<form method="post" action="{{route('users.store')}}">
					<div class="col-md-6">
						<div class="position-relative form-group">
							<label for="firstname" class="">First Name</label>
							<input name="firstname" placeholder="First Name" type="text" value="{{old('firstname')}}" class="form-control" />
							@if($errors->has('firstname'))
							<span>
								<strong class="invalid-feedback">{{ $errors->first('firstname') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-md-6">
						<div class="position-relative form-group">
							<label for="lastname" class="">Last name</label>
							<input name="lastname" placeholder="Last Name" type="text" value="{{old('lastname')}}" class="form-control" />
							@if($errors->has('lastname'))
							<span>
								<strong class="invalid-feedback">{{ $errors->first('lastname') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-md-6">
						<div class="position-relative form-group">
							<label for="email" class="">Email</label>
							<input name="email" placeholder="Email" type="email" value="{{old('email')}}" class="form-control" />
							@if($errors->has('email'))
							<span>
								<strong class="invalid-feedback">{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-md-6">
						<div class="position-relative form-group">
							<label for="mobile" class="">Mobile</label>
							<input name="mobile" placeholder="Mobile No." type="text" value="{{old('mobile')}}" class="form-control" />
							@if($errors->has('mobile'))
							<span>
								<strong class="invalid-feedback">{{ $errors->first('mobile') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<button class="mt-1 btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(document).ready(function() {

		if ($('#pageError').length !== 0) {
			Swal.fire(
				'Error',
				$('#pageMessage').attr('data-message'),
				'danger'
			)
		}
	});
</script>
@endpush
