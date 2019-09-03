@extends('crudbooster::admin_template')
@section('content')

        <div >

          @if (session('status'))
              <div class="alert alert-danger">
                  <p style="text-align: center;">
                  {{ session('status') }}
                  </p>
              </div>
          @endif

        @if(CRUDBooster::getCurrentMethod() != 'getProfile' && $button_cancel)
          @if(g('return_url'))
          <p><a title='Return' href='{{g("return_url")}}'><i class='fa fa-chevron-circle-left '></i> &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
          @else
          <p><a title='Main Module' href='{{CRUDBooster::mainpath()}}'><i class='fa fa-chevron-circle-left '></i> &nbsp; {{trans("crudbooster.form_back_to_list",['module'=>CRUDBooster::getCurrentModule()->name])}}</a></p>
          @endif
        @endif

        <div class="panel panel-default">
           <div class="panel-heading">
             <strong><i class='{{CRUDBooster::getCurrentModule()->icon}}'></i> {!! $page_title or "Page Title" !!}</strong>
             <br><br>
              @if($command != 'add')
                @foreach ($sub_module as $sm)
                    <a href="<?php echo CRUDBooster::adminPath($sm['path']).'?parent_table='.$table.'&parent_columns='.$sm['parent_columns'].'&custom_parent_alias='.$sm['custom_parent_alias'].'&parent_id='.$id.'&return_url='.CRUDBooster::adminPath().'%2F'.$table.'%3Fm%3D36&foreign_key='.$sm['foreign_key'].'&label=Sample+Request';?>"><button type="button" class="btn btn-info">Sample Request</button></a>
                @endforeach
              @endif
           </div>

           <div class="panel-body" style="padding:20px 0px 0px 0px">
                <?php
                  $action = (@$row)?CRUDBooster::mainpath("edit-save/$row->id"):CRUDBooster::mainpath("add-save");
                  $return_url = ($return_url)?:g('return_url');
                ?>
                <form class='form-horizontal' method='post' id="form" enctype="multipart/form-data" action='{{$action}}'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type='hidden' name='return_url' value='{{ @$return_url }}'/>
                <input type='hidden' name='ref_mainpath' value='{{ CRUDBooster::mainpath() }}'/>
                <input type='hidden' name='ref_parameter' value='{{urldecode(http_build_query(@$_GET))}}'/>
                @if($hide_form)
                  <input type="hidden" name="hide_form" value='{!! serialize($hide_form) !!}'>
                @endif
                        <div class="box-body" id="parent-form-area">

                          @if($command == 'detail')
                             @include("crudbooster::default.form_detail")
                          @else
                             @include("crudbooster::default.form_body")
                          @endif
                        </div><!-- /.box-body -->

                        <div class="box-footer" style="background: #F5F5F5">

                          <div class="form-group">
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-10">
                              @if($button_cancel && CRUDBooster::getCurrentMethod() != 'getDetail')
                                @if(g('return_url'))
                                <a href='{{g("return_url")}}' class='btn btn-default'><i class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
                                @else
                                <a href='{{CRUDBooster::mainpath("?".http_build_query(@$_GET)) }}' class='btn btn-default'><i class='fa fa-chevron-circle-left'></i> {{trans("crudbooster.button_back")}}</a>
                                @endif
                              @endif
                              @if(CRUDBooster::isCreate() || CRUDBooster::isUpdate())

                                 @if(CRUDBooster::isCreate() && $button_addmore==TRUE && $command == 'add')
                                    <input type="submit" name="submit" value='{{trans("crudbooster.button_save_more")}}' class='btn btn-success'>
                                 @endif

                                 @if($button_save && $command != 'detail')
                                    <input type="submit" name="submit" value='{{trans("crudbooster.button_save")}}' class='btn btn-success'>
                                 @endif

                              @endif
                            </div>
                          </div>

                        </div><!-- /.box-footer-->

                        </form>

            </div>
        </div>
        </div><!--END AUTO MARGIN-->
        @if($command != 'detail')
          <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
          <!-- validation code -->
          {!! $validator !!}
          <!-- validation code end -->
        @endif

        <script type="text/javascript">
          $(document).ready(function () {
            $('#form-group-optin_subscriptions').hide();
            $('#family-allergy-history-description').hide();
            $('#optin').change(function() {
              if($('#optin').val()=='Yes')
              {
                $('#form-group-optin_subscriptions').show();
              }
              else
              {
                $('#form-group-optin_subscriptions').hide();
              }
            });

            $('#childrenfamily_allergy_history').change(function(){
              if($('#childrenfamily_allergy_history').val()=='Yes')
              {
                $('#family-allergy-history-description').show();
              }
              else
              {
                $('#family-allergy-history-description').hide();
              }
            });
          });
        </script>

@endsection
