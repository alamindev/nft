@section('title')
Profile
@endsection
@push('styles')
@include('frontend.includes.datatablecss')
@endpush
@push('scripts')
@include('frontend.includes.datatablejs')
    <script>
        setTimeout(function(){
            $(document).ready(function() {
                var table = $('#example').DataTable( {
                        responsive: true,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('ads') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'name', name: 'name'},
                            {
                                data: 'desktop_ads',
                                name: 'Desktop ads',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'mobile_ads',
                                name: 'Mobile ads',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'created_date',
                                name: 'Created date',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'status',
                                name: 'Status',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: true,
                                searchable: true
                            },
                        ]
                    } )
                    .columns.adjust()
                    .responsive.recalc();
            } );
            $('#example').on('click', '.delete', function (e) {
                    Swal.fire({
                            title: 'Are you sure?',
                            text: 'You will not be able to recover this Data!',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, keep it'
                            }).then((result) => {
                                if (result.value) {
                                    e.preventDefault();
                                        var url = $(this).data('remote');
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url:url ,
                                            type: 'DELETE',
                                            dataType: 'json',
                                            data: {method: '_DELETE', submit: true}
                                        }).always(function (data) {
                                            if(data.message == 'error'){
                                            Swal.fire(
                                                'Error!',
                                                'Something went wrong',
                                                'error'
                                                )
                                            }else{
                                                Swal.fire(
                                                'Deleted!',
                                                'Your Data has been deleted.',
                                                'success'
                                                )
                                            $('#example').DataTable().draw(false);
                                            }

                                        });
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    Swal.fire(
                                    'Cancelled',
                                    'Your Data file is safe :)',
                                    'error'
                                    )
                                }
                            })
                    });
        }, 100)
    </script>
@endpush
<x-app-layout>
    <div class="sm:py-10  lg:px-16">
        <div class="container mx-auto">
            <div class="flex flex-col sm:flex-row">
                <div class="sm:w-2/6 pb-2 sm:pb-0  sm:pr-2 md:pr-5" >
                    @include('frontend.includes.sidebar')
                </div>
                <div class="sm:w-4/6   sm:pl-2 md:pl-5">
                    <div class="bg-white p-5">
                        <div class="flex w-full items-center justify-between border-b pb-2">
                            <p class="text-lg text-gray-800 dark:text-gray-100 font-bold">Ads</p>
                            <a href="{{ route('ads.create') }}" class="btn bg-indigo-600 text-white hover:bg-indigo-700">Create ads</a>
                        </div>
                        <div class="hidden text-xs text-purple-600"><span class="text-red-600"></span></div>
                        <div class="py-5">
                            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                                <thead>
                                    <tr>
                                        <th data-priority="1">Id</th>
                                        <th data-priority="1">Name</th>
                                        <th data-priority="2">Desktop ads</th>
                                        <th data-priority="3">Mobile ads</th>
                                        <th data-priority="4">Created date</th>
                                        <th data-priority="4">Status</th>
                                        <th data-priority="5">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


