@extends('layouts.admin')
@section('header', 'transaction')

@section('css')
<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
@role('admin')
<div id="controller">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('transactions/create') }}"  class="btn btn-primary">Create New Transactions</a>
            <div class="card-tools">
                <div class='input-group date' id='datetimepicker'>
                    <input type='date' class="form-control" name="loan_date">
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <!-- Status Filter -->
            <div class="card-tools mr-3">
                <select class="form-control" name="status">
                    <option value="2">Status Filter</option>
                    <option value="0">On Loan</option>
                    <option value="1">Returned</option>
                </select>
            </div>
        </div>
        </div>

        <div class="card-body table-responsive">
        <table class="table table-striped table-bordered" id="dataTable">
        <thead>
            <tr>
                <th style="width: 10px">tanggal pinjam</th>
                <th class="text-center">tanggal kembali</th>
                <th class="text-center">nama peminjam</th>
                <th class="text-center">lama pinjam (hari)</th>
                <th class="text-center">total buku</th>
                <th class="text-center">total bayar</th>
                <th class="text-center">Status</th>
                <th>Action</th>
              </tr>
        </thead>
        </table>
        </div>



    </div>
</div>
@endrole
@endsection


@section('js')
<!-- Datatables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>



 <script type="text/javascript">
    var actionUrl = '{{ url('transactions') }}';
	var apiUrl = '{{ url('api/transactions') }}';

	var columns = [
		// {
		// 	data: 'DT_RowIndex',
		// 	class: 'text-center',
		// 	orderable: true
		// },
		{data: 'date_start', class: 'text-center', orderable: true},
		{data: 'date_end', class: 'text-center', orderable: true},
		{data: 'name', class: 'text-left', orderable: true},
		{data: 'duration', class: 'text-center', orderable: true},
		{data: 'total_transactions', class: 'text-center', orderable: false},
		{data: 'total_costs', class: 'text-center', orderable: false},
		{data: 'status', class: 'text-center', orderable: true},
        {render: function(index, row, data, meta) {
                return `

                <div class="col">
					<a href="{{ url('/transactions') }}/${data.id}" class="btn btn-primary btn-sm">
						Detail
					</a>
				</div>
                    <a href="/transactions/${data.id}/edit" class="btn btn-warning" onclick="controller.editData(event, ${meta.row})">
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
                        Delete
                    </a>
            `
            }, orderable: false, width: '200px',class: 'text-center'
        }
    ]
    var controller = new Vue({
        el: '#controller',
        data: {
            datas: [],
            data: {},
            anggota: {},
            actionUrl,
            apiUrl,
            info: '',
            editStatus: false,
        },
        mounted: function() {
            this.datatable()
        },
        methods: {
            datatable() {
                const _this = this
                _this.table = $('#dataTable').DataTable({
                    ajax: {
                        url: _this.apiUrl,
                        type: 'GET'
                    },
                    columns
                }).on('xhr', function() {
                    _this.datas = _this.table.ajax.json().data;
                })
            },
            addData() {
                this.editStatus = false;
                this.info = 'Create';
                this.data = {};
                $('#modal-default').modal();
            },
            editData(event, row) {
                this.data = this.datas[row];
                this.editStatus = true;
                this.info = 'Update';
                $('#modal-default').modal();
            },
            deleteData(event, id) {
                if (confirm("Are you sure ?")) {
            $(event.target).parents('tr').remove();
            axios.post(this.actionUrl+'/'+id, {_method: 'DELETE'}).then(response => {
              alert('Data has been removed');
            });
          }
            },
            submitForm(event, id) {
                event.preventDefault()
                const _this = this
                var actionUrl = !this.editStatus ? this.actionUrl : this.actionUrl + '/' + id
                axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                    $('#modal-default').modal('hide')
                    _this.table.ajax.reload()
                })
            }
        }
    })
</script>
<script type="text/javascript">
	$('select[name=status]').on('change', function() {
        status = $('select[name=status]').val()
        if (status == 2) {
            controller.table.ajax.url(apiUrl).load()
        } else {
            controller.table.ajax.url(apiUrl + '?status=' + status).load()
        }
    });
    $('input[name=loan_date]').on('change', function() {
	    date_start = $('input[name=loan_date]').val()
	    controller.table.ajax.url(apiUrl + '?date_start=' + date_start).load()
	});
</script>
@endsection

