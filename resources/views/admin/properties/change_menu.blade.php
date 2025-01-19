<div class="form-group col-md-3 m-b-4 mb-3">
	@php
		$current_route_name = Route::currentRouteName();
	@endphp
	<select class="form-select" name="change_property_link" id="change_property_link" style="border: 1px solid black;">
		<option value="{{route('admin.properties')}}" {{(($current_route_name == 'admin.properties')?'selected':'')}}> Properties</option>

		@can('industrial-property-list')
		<option value="{{route('admin.industrial.properties')}}" {{(($current_route_name == 'admin.industrial.properties')?'selected':'')}}> Industrial Property</option>
		@endcan
		
		@can('land-property-list')
		<option value="{{route('admin.land.properties')}}" {{(($current_route_name == 'admin.land.properties')?'selected':'')}}> Land Property</option>
		@endcan

		<option value="{{route('admin.shared.properties')}}" {{(($current_route_name == 'admin.shared.properties')?'selected':'')}}> Shared Property</option>
	</select>
</div>
