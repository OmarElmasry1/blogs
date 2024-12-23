@extends('layouts.auth');



@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('content')





    <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
    <div class="content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card" style="height: 140px">
                        <div class="card-header">
                            <h2>{{$userCount}}</h2>

                            <div class="sub-title">
                                <span class="mr-1" style="font-size: 20px">users</span> |

                                <i class="fa-sharp fa-solid fa-user" style="font-size: 23px"></i>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card" style="height: 140px">
                        <div class="card-header">
                            <h2>{{$postCount}}</h2>

                            <div class="sub-title">
                                <span class="mr-1" style="font-size: 20px">posts</span> |

                                <i class="fa-solid fa-address-card" style="font-size: 23px"></i>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card" style="height: 140px">
                        <div class="card-header">
                            <h2>{{$categoryCount}}</h2>

                            <div class="sub-title">
                                <span class="mr-1" style="font-size: 20px">categories</span> |

                                <i  class="fa-solid fa-list"style="font-size: 23px"> </i>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card card-default card" style="height: 140px">
                        <div class="card-header">
                            <h2>{{$tagCount}}</h2>

                            <div class="sub-title">
                                <span class="mr-1" style="font-size: 20px">tags</span> |
                                <i class="fa-solid fa-tag" style="font-size: 23px"> </i>

                            </div>
                        </div>

                    </div>
                </div>
            </div>






@endsection
