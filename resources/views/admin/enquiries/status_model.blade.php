<div class="modal fade" id="status" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alert</h5>
                <button class="btn-close btn-light" type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.updateEnquiryStatus') }}" method="get" id="status" novalidate="">
                    @csrf
                    <span> Are You Sure You Wants To Update Status ?</span>
                    @if (isset($data))
                    <input type="hidden" name="flag" id="flag" value="edit">
                    <input type="hidden" name="id" id="schedule_visit_id" value="{{$data->id}}" hidden>
                    @else
                    <input type="hidden" name="id" id="schedule_visit_id">
                  @endif
                    <div class="text-center mt-3">
                        <button class="btn custom-theme-button" type="submit" id="">Yes</button>
                        <button class="btn btn-primary ms-3" style="border-radius: 5px;" type="button"
                            data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
