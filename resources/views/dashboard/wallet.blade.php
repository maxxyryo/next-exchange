@extends('_layouts.main')

@section('content')
    <div id="main-container">
  <div class="banner banner-mini bg-blue">
        <span data-lang-id="dashboard_pageTitle">Wallet</span>
    </div>


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                    @endif

                           @include('_partials.dashboard-sidenav')


                            <div class="page-wrapper" style="padding-left:240px; padding-top: 40px;">

                                <!-- ============================================================== -->
                                <!-- Container fluid  -->
                                <!-- ============================================================== -->
                                <div class="container-fluid">
                                    <!-- ============================================================== -->
                                    <!-- Bread crumb and right sidebar toggle -->
                                    <!-- ============================================================== -->
                                    <div class="row page-titles">
                                        <div class="col-md-5 align-self-center">
                                            <h3 class="text-themecolor">WALLET</h3>
                                        </div>
                                        <div class="col-md-7 align-self-center">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                                <li class="breadcrumb-item">Dashboard</li>
                                                <li class="breadcrumb-item active">Wallet</li>
                                            </ol>
                                        </div>

                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- End Bread crumb and right sidebar toggle -->
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->
                                    <!-- Start Page Content -->
                                    <!-- ============================================================== -->
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <table>
                                            <tr>
                                            <th>Token</th>
                                                <th>Amount</th>
                                            </tr>

                                            @foreach ($wallets as $wallet)
                                                <tr>
                                                    <td>{{ $wallet->token->name }}</td>
                                                    <td>{{ $wallet->amount }}</td>

                                                </tr>

                                            @endforeach

                                            </table>
                                            </div>
                                    </div>

                                </div>
                            </div>



        </div>


@endsection
