@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fa fa-globe"></i> شيتوس ستور.
                        <small class="float-right">التاريخ: {{ $order->created_at }}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        من
                        <address>
                            <strong>ابراهيم شتات</strong><br>
                            01222222222222<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        الى
                        <address>
                            <strong> {{ $order->client_name }} </strong><br>
                            {{ $order->client_phone }}<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>فاتورة #</b> {{ \Str::random(6) }} <br>
                        <br>
                        <b>رقم الطلب:</b> {{ $order->id }}<br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الكميه</th>
                                    <th>السعر</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td> {{ $item->product->name }} </td>
                                        <td> {{ $item->quantity }} </td>
                                        <td> {{ $item->price }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">

                    <!-- /.col -->
                    <div class="col-6">
                        <p class="lead">
                            التاريخ: {{ $order->created_at }}
                        </p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Total:</th>
                                        <td> {{ $order->price }} جنيه مصري </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">

                        <a href="" target="_blank" class="btn btn-default"><i
                                class="fa fa-print"></i> Print</a>

                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> Generate PDF
                        </button>

                    </div>
                </div>

            </div>
            <!-- /.invoice -->
        </div>


    </div>
</div>


@endsection
