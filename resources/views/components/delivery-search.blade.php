@extends('layouts.delivery-layout')
@section('titlePage', 'Delivery Search')
@section('content')
    <nav class="navbar bg-body-tertiary">
        <b class="name-navbar">納入先一覧</b>
    </nav>

    <nav class="navbar nav-condition">
        <p class="name-navbar">検索条件</p>
    </nav>

    <div class="container-fluid content-style">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <label>納入先コード</label>
                        <div class="input-group mb-3">
                            <input
                                id="delivery_id_search"
                                type="text"
                                class="form-control"
                            />
                        </div>
                        <span class="error-message" id="delivery_id_search_error"></span>
                    </div>
                    <div class="col-md-4">
                        <label>納入先名</label>
                        <div class="input-group mb-3">
                            <input
                                id="delivery_name_1_search"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>フリガナ</label>
                        <div class="input-group mb-3">
                            <input
                                id="furigana_search"
                                type="text"
                                class="form-control"
                            />
                        </div>
                        <span class="error-message" id="furigana_search_error"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <label>住所</label>
                        <div class="input-group mb-3">
                            <input
                                id="address_search"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>電話番号</label>
                        <div class="input-group mb-3">
                            <input
                                id="phone_search"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <label>納入先分類１</label>
                        <div class="input-group mb-3">
                            <select
                                id="delivery_category_1_search"
                                class="form-select"
                            >
                                <option selected></option>
                                @foreach($delivery_category as $item)
                                    <option
                                        value="{{$item->category_delivery_id}}">{{$item->cate_delivery_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>納入先分類2</label>
                        <div class="input-group mb-3">
                            <select
                                id="delivery_category_2_search"
                                class="form-select"
                            >
                                <option selected></option>
                                @foreach($delivery_category as $item)
                                    <option
                                        value="{{$item->category_delivery_id}}">{{$item->cate_delivery_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>納入先分類3</label>
                        <div class="input-group mb-3">
                            <select
                                id="delivery_category_3_search"
                                class="form-select"
                            >
                                <option selected></option>
                                @foreach($delivery_category as $item)
                                    <option
                                        value="{{$item->category_delivery_id}}">{{$item->cate_delivery_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
        <hr/>
        <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <table class="table table-striped table-bordered table-hover" id="table-search">
                       <thead>
                       <tr class="table-search-head">
                           <th scope="col">納入先コード</th>
                           <th scope="col">納入先名</th>
                           <th scope="col">フリガナ</th>
                           <th scope="col">住所</th>
                           <th scope="col">電話番号</th>
                           <th scope="col">納入先分類1</th>
                           <th scope="col">納入先分類2</th>
                           <th scope="col">納入先分類3</th>
                       </tr>
                       </thead>
                       <tbody>

                       </tbody>
                   </table>
               </div>
           </div>
        </div>
        <br/>
    </div>
@endsection

@section('navbar-bottom')
    <a href="javascript:void(0);" id="btnBackPageBefore" class="btnBack"><b>< 戻る</b></a>
    <div class="area-button">
        <button id="btnChangePageNew" class="btn btn-bgrwhite btn-custom">新規追加</button>
        <button id="btnClearSearchDelivery" class="btn btn-bgrwhite btn-custom">クリア</button>
        <button id="btnExportExcel" class="btn btn-bgrwhite btn-custom">EXCEL</button>
        <button id="btnSearchDelivery" class="btn btn-bgrwhite btn-custom">検索🔍</button>
    </div>
@endsection

@section('add-modal')
    @include('layouts.include.modal.confirm-back-modal')
    @include('layouts.include.modal.preview-excel-modal')
@endsection

@push('scripts')
    <script src="{{asset('assets/js/delivery-search.js')}}"></script>
@endpush

