@extends('layouts.delivery-layout')
@section('titlePage', 'Delivery Detail')
@section('content')
    <!--Navbar bottom-->
    <nav class="navbar bg-body-tertiary" id="nav-info">
        <b class="name-navbar">納入先マスター</b>
        <!-- Infor Author in javascript-->
    </nav>

    <form id="formInsertDelivery">
        <div class="container-fluid content-style">
            <div class="row">
                <div class="col-md-3">
                    <label>納入先コード <span class="label-red">*</span></label>
                    <div class="input-group mb-3">
                        <input
                            id="delivery_id"
                            type="text"
                            class="form-control"
                        />
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="btnSearch" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <span class="error-message" id="delivery_id_error"></span>
                </div>
                <div class="col-md-3">
                    <label>納入先名1 <span class="label-red">*</span></label>
                    <div class="input-group mb-3">
                        <input
                            id="delivery_name_1"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <span class="error-message" id="delivery_name_1_error"></span>
                </div>

                <div class="col-md-3">
                    <label>納入先名2</label>
                    <div class="input-group mb-3">
                        <input
                            id="delivery_name_2"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <span class="error-message" id="delivery_name_2_error"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label
                                >フリガナ1 <span class="label-red">*</span></label
                                >
                                <div class="input-group mb-3">
                                    <input
                                        id="furigana_1"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <span class="error-message" id="furigana_1_error"></span>
                            </div>

                            <div class="col-md-6">
                                <label>フリガナ2</label>
                                <div class="input-group mb-3">
                                    <input
                                        id="furigana_2"
                                        type="text"
                                        class="form-control"
                                    />
                                </div>
                                <span class="error-message" id="furigana_2_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label
                            >郵便番号 <span class="label-red">*</span></label
                            >
                            <div class="input-group mb-3">
                                <input
                                    id="zipcode"
                                    type="text"
                                    class="form-control"
                                    autocomplete="off"
                                />
                            </div>
                            <span class="error-message" id="zipcode_error"></span>
                        </div>

                        <div class="col-md-6">
                            <label
                            >都道府県 <span class="label-red">*</span></label
                            >
                            <div class="input-group mb-3">
                                <select id="province" class="form-select">
                                    <option></option>
                                </select>
                            </div>
                            <span class="error-message" id="province_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label>市区町村 <span class="label-red">*</span></label>
                    <div class="input-group mb-3">
                        <input
                            id="city"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <span class="error-message" id="city_error"></span>
                </div>
                <div class="col-md-4">
                    <label>町・番地 <span class="label-red">*</span></label>
                    <div class="input-group mb-3">
                        <input
                            id="town"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <span class="error-message" id="town_error"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>マンション・ビル名</label>
                    <div class="input-group mb-3">
                        <input
                            id="address_home"
                            type="text"
                            class="form-control"
                        />
                    </div>
                    <span class="error-message" id="address_home_error"></span>
                </div>
                <div class="col-md-4">
                    <label>住所１</label>
                    <div class="input-group mb-3">
                        <input
                            id="address_1"
                            type="text"
                            class="form-control"
                            disabled
                        />
                    </div>
                </div>
                <div class="col-md-4">
                    <label>住所２</label>
                    <div class="input-group mb-3">
                        <input
                            id="address_2"
                            type="text"
                            class="form-control"
                            disabled
                        />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <label
                            >電話番号 <span class="label-red">*</span></label
                            >
                            <div class="input-group mb-3">
                                <input
                                    id="phone"
                                    type="text"
                                    class="form-control"
                                />
                            </div>
                            <span class="error-message" id="phone_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label>FAX番号</label>
                            <div class="input-group mb-3">
                                <input
                                    id="fax_number"
                                    type="text"
                                    class="form-control"
                                />
                            </div>
                            <span class="error-message" id="fax_number_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label>納入先分類1</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="category_delivery_1">
                                    <option selected></option>
                                    @foreach($category_deliveries as $cate)
                                        <option value="{{$cate->category_delivery_id}}">{{$cate->cate_delivery_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>納入先分類2</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="category_delivery_2">
                                    <option selected></option>
                                    @foreach($category_deliveries as $cate)
                                        <option value="{{$cate->category_delivery_id}}">{{$cate->cate_delivery_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>納入先分類3</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="category_delivery_3">
                                    <option selected></option>
                                    @foreach($category_deliveries as $cate)
                                        <option value="{{$cate->category_delivery_id}}">{{$cate->cate_delivery_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>備考</label>
                    <div class="input-group mb-3">
                        <textarea id="note" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <span class="error-message" id="note_error"></span>
                </div>
                <div class="col-md-6"></div>
            </div>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
    </form>
@endsection

@section('navbar-bottom')
    <a href="javascript:void(0);" id="btnBackPageBefore" class="btnBack"><b>< 戻る</b></a>
    <div class="area-button">
        <button id="btnDeleteDelivery" class="btn btn-danger btn-custom">削除</button>
        <button id="btnCopyDelivery" class="btn btn-bgrwhite btn-custom">複写</button>
        <button id="btnNewDelivery" class="btn btn-bgrwhite btn-custom">新規</button>
        <button id="btnSaveDelivery" class="btn btn-primary btn-custom">登録</button>
    </div>
@endsection

@section('add-modal')
    @include('layouts.include.modal.search-delivery-modal')
    @include('layouts.include.modal.confirm-back-modal')
    @include('layouts.include.modal.confirm-change-new-mode')
    @include('layouts.include.modal.confirm-copy-delivery')
    @include('layouts.include.modal.confirm-delete-delivery')
    @include('layouts.include.modal.confirm-add-delivery')
    @include('layouts.include.modal.confirm-edit-delivery')
@endsection

@push('scripts')
    <script src="{{asset('assets/js/delivery-detail.js')}}"></script>
@endpush


