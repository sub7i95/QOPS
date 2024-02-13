<div class="modal fade" id="modal-coached" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  class="form" role="form" method="post" action="{{ url("/tickets/{$ticket->id}/coached") }}">
                @csrf
                <input type="hidden" name="_method" id="_method" value="POST">
                <input type="hidden" name="ticket_id" id="ticket_id" value="{{ $ticket->id }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-success" id="exampleModalLabel">Ticket Coached</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold"> Are you sure?</p>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Yes, Coached</button>
                </div>
            </form>
        </div>
    </div>
</div>
