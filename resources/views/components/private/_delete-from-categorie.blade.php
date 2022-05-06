<!--Modal delete item-->
<div class="modal" id="modalDeleteFromCategorie-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCategorieLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body border border-2 border-warning rounded-3">
        <div class="d-flex justify-content-center align-items-center ">
          <i class="fa fa-warning text-warning fa-5x"></i>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-3">
          <h4  class="text-uppercase font-weight-bold text-center">{{ __('admin-dashboard.categories-action-table-delete', ['attribute' => $item->name]) }}</h4>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-3 row">
          <form action="{{ route('admins.categories-destroy',$item->id) }}" method="POST">
            @csrf
            @method("DELETE")
            <div class="row">
              <div class="col d-grid gap-2">
                <button class="btn btn-success text-white" type="submit"> {{ __('admin-dashboard.categories-dt-btn-modal') }}<i class="fa fa-check"></i></button>
              </div>
              <div class="col d-grid gap-2">
                <button class="btn btn-danger" type="button" data-bs-dismiss="modal" >{{ __('admin-dashboard.categories-cancel-btn-modal') }}<i class="fa fa-close"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
