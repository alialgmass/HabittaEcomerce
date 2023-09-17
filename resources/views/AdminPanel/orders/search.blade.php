<div class="modal fade text-md-start" id="searchOrders" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{trans('common.search')}}</h1>
                </div>
                {{Form::open(['url'=>route('orders.index'), 'id'=>'searchOrdersForm', 'class'=>'row gy-1
                pt-75','method'=>'GET'])}}
                <div class="col-12 col-md-4">
                    <label class="form-label" for="client_id">{{trans('common.client')}}</label>
                    {{Form::select('client_id',
                    [''=>trans('common.allClients')]
                    + App\Models\User::pluck('name','id')->all(),
                    isset($_GET['client_id']) ? $_GET['client_id'] : '',['id'=>'client_id', 'class'=>'form-control
                    selectpicker','data-live-search'=>'true'])}}
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="status">{{trans('common.status')}}</label>
                    {{Form::select('status',
                    [
                    '' => trans('common.allStatuses'),
                    'processing' => trans('common.processing'),
                    'inTheWay' => trans('common.inTheWay'),
                    'completed' => trans('common.completed'),
                    'cancelled' => trans('common.cancelled'),
                    ],isset($_GET['status']) ? $_GET['status'] : '',
                    ['id'=>'status','class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label" for="order_number">{{trans('common.order_number')}}</label>
                    {{Form::text('order_number',isset($_GET['order_number']) ? $_GET['order_number'] :
                    '',['id'=>'order_number',
                    'class'=>'form-control'])}}
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="from_date">{{trans('common.from_date')}}</label>
                    {{Form::date('from_date',isset($_GET['from_date']) ? $_GET['from_date'] : '',['id'=>'from_date',
                    'class'=>'form-control'])}}
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="to_date">{{trans('common.to_date')}}</label>
                    {{Form::date('to_date',isset($_GET['to_date']) ? $_GET['to_date'] : '',['id'=>'to_date',
                    'class'=>'form-control'])}}
                </div>
                <div class="col-12 text-center mt-2 pt-50">
                    <button type="submit" class="btn btn-primary me-1">{{trans('common.search')}}</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        {{trans('common.Cancel')}}
                    </button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
