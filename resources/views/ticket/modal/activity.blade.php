<!-- Forgot Password Modal -->
<div class="modal fade" id="modal-show-activity" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form name="form-ticket-begin" id="form-ticket-begin" class=" form-horizontal ajax-form-update-activity" role="form" action="/tickets/{{ $ticket->ref_number }}/acttivity">
                <input type="hidden" name="_method" id="_method" value="PUT">
                <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Activity </h4>
                </div>
                <div class="modal-body">
                    <table id="table_activity" class="table table-striped table-bordered table-hover table-checkable order-column">
                    </table>
                    <table id="dataTable" class="table table-striped table-bordered table-hover ">
                        <tr>
                            <td> <b> ID </b> </td>
                            <td> <b> Name </b> </td>
                            <td> <b> Analyst </b> </td>
                            <td> <b> Compliance </b> </td>
                            <td> <b> Notes <b> </td>
                        </tr>
                        @foreach( $activities as $activity )
                        <tr>
                            <td> {{ $activity->id }} <input type="hidden" name="id[]" value="{{ $activity->id }}"></td>
                            <td> {{ $activity->name }} </td>
                            <td> {{ $activity->analyst }} </td>
                            <td>
                                <select name="score[]" id="score" class="form-control input-sm">
                                    <option value="-1" @if( $activity->score==-1 ) echo 'selected' @endif >N/A</option>
                                    <option value="0" @if( $activity->score==0 ) echo 'selected' @endif >No</option>
                                    <option value="1" @if( $activity->score==1 ) echo 'selected' @endif >Yes</option>
                                </select>
                            </td>
                            <td> <input type="text" class="form-control input-sm" placeholder="add notes" name="notes[]" value="{{ $activity->notes }}" /> </td>
                        </tr>
                        @endforeach
                    </table>
                    <span class="showError alert-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-sm btn-circle" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm " data-loading-text="Loading..." id="btn-save-activity">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
