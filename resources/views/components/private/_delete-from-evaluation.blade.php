<!--Modal delete evaluation-->
<div class="modal" id="modalDeleteFromEvaluation{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteEvaluationLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body border border-2 border-warning rounded-3">
        <div class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center">
          <i class="fa fa-warning text-warning fa-5x"></i>
        </div>
        <div class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex d-xxl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center justify-content-xxl-center align-items-xxl-center mt-3">
          <h4  class="text-uppercase font-weight-bold text-center">{{ __('admin-dashboard.evaluations-action-table-deleteEva', ['attribute' => $item->name]) }}</h4>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-3 row">
          <form action="{{ route('admin.evaluations-destroy',$item->id) }}" method="POST">
            @csrf
            @method("DELETE")
            <div class="row">
              <div class="col d-grid gap-2">
                <button class="btn btn-success text-white" type="submit"> {{ __('admin-dashboard.evaluations-dt-btn-modal') }}<i class="fa fa-check"></i></button>
              </div>
              <div class="col d-grid gap-2">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal" >{{ __('admin-dashboard.evaluations-cancel-btn-modal') }}<i class="fa fa-close"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
