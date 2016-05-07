@extends('layouts.master-advance')
@section('container')
    {!!Html::style('/css/year-calendar.css')!!}
    {!!Html::script('/js/year-calendar.js')!!}
    {!!Html::style('/datepicker/datetimepicker.css')!!}
    {!!Html::script('/datepicker/moment.js')!!}
    {!!Html::script('/datepicker/datetimepicker.js')!!}
    <div id="kalendar" style="margin-top:30px"></div>
    <div class="modal modal-fade in" id="event-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">
                        Event
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="event-index" value="">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="min-date" class="col-sm-4 control-label">Name</label>
                            <div class="col-sm-7">
                                <input name="event-name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="min-date" class="col-sm-4 control-label">Location</label>
                            <div class="col-sm-7">
                                <input name="event-location" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="min-date" class="col-sm-4 control-label">Dates</label>
                            <div class="col-sm-7">
                                <div class="input-group input-daterange" data-provide="datepicker">
                                    <input name="event-start-date" type="text" class="form-control" value="2012-04-05">
                                    <span class="input-group-addon">to</span>
                                    <input name="event-end-date" type="text" class="form-control" value="2012-04-19">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save-event">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('#kalendar').calendar({
                enableRangeSelection: true,
                mouseOnDay: function(e){
                    if(e.events.length > 0){
                        var content = '';
                        for(var i in e.events){
                            content += '<div class="event-tooltip-content">'
                                    + '<b>' + e.events[i].vreme + '</b>'
                                    + '<div class="event-name" style="color:' + e.events[i].color + '">' + e.events[i].naslov + '</div>'
                                    + '<div class="event-location">' + e.events[i].mesto + '</div>'
                                    + '</div><hr>'
                        }
                        $(e.element).popover({
                            trigger: 'manual',
                            container: 'body',
                            html:true,
                            content: content
                        });
                        $(e.element).popover('show')
                    }
                },
                mouseOutDay: function(e) {
                    if(e.events.length > 0){ $(e.element).popover('hide') }
                },
                dayContextMenu: function(e) {
                    $(e.element).popover('hide')
                },
                dataSource: {!!$kalendar!!}
            });
        });
    </script>
@endsection