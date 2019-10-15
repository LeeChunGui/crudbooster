@if($gigya_customer)
<div class="customize">
<label style="text-align:left"  class='control-label col-sm-4'>{{$form['label']}} {!!($required)?"<span class='text-danger' title='This field is required'>*</span>":"" !!}</label>
@else
<div class='form-group form-datepicker {{$header_group_class}} {{ ($errors->first($name))?"has-error":"" }}' id='form-group-{{$name}}' style="{{@$form['style']}}">
<label class='control-label col-sm-2'>{{$form['label']}} {!!($required)?"<span class='text-danger' title='This field is required'>*</span>":"" !!}</label>
@endif
	<div class="{{$col_width?:'col-sm-10'}}">
		<div class="input-group">  								
			<span class="input-group-addon open-datetimepicker"><a><i class='fa fa-calendar '></i></a></span>
			<input type='text' title="{{$form['label']}}" readonly {{$required}} {{$readonly}} {!!$placeholder!!} {{$disabled}} class='form-control notfocus input_date' name="{{$name}}" id="{{$name}}" value='{{substr($value, 0, 10)}}'/>						
		</div>
		<div class="text-danger">{!! $errors->first($name)?"<i class='fa fa-info-circle'></i> ".$errors->first($name):"" !!}</div>
		<p class='help-block'>{{ @$form['help'] }}</p>
	</div>
</div>

