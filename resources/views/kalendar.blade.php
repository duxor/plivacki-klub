@extends('layouts.master-advance')
@section('container')
    {!!Html::style('/css/year-calendar.css')!!}
    {!!Html::script('/js/year-calendar.js')!!}
    {!!Html::style('/datepicker/datetimepicker.css')!!}
    {!!Html::script('/datepicker/moment.js')!!}
    {!!Html::script('/datepicker/datetimepicker.js')!!}
    <div id="kalendar" style="margin-top:30px"></div>
    <div class="modal modal-fade in" id="event-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">
                        Pregled događaja
                    </h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
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
                clickDay:function(e){
                    console.log(e.date);
                    if(e.events.length > 0){
                        var content = '';
                        for(var i in e.events){
                            content +=
                                    '<a href="/'+e.events[i].slug+'" style="color:#000"><b>' + e.events[i].vreme + ':</b> <span class="event-name" style="colorr:' + e.events[i].color + '">' + e.events[i].naslov + '</span> (' + e.events[i].mesto + ')'
                                    + '</a><br>'
                        }
                        $('.modal-body').html(content);
                        $('#event-modal').modal('show');
                    }
                },
                dataSource: {!!$kalendar!!}
            });
        });
    </script>
@endsection