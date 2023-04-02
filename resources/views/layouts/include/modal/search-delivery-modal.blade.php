<div class="modal fade" id="searchDeliveryModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">配達を探す</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>納入先コード</label>
                        <div class="input-group mb-3">
                            <input
                                id="delivery_id_search_detail"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>納入先名</label>
                        <div class="input-group mb-3">
                            <input
                                id="delivery_name_1_search_detail"
                                type="text"
                                class="form-control"
                            />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>フリガナ</label>
                        <div class="input-group mb-3">
                            <input
                                type="text"
                                id="furigana_1_search_detail"
                                class="form-control"
                            />
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
                                        id="delivery_category_1_search_detail"
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
                                        id="delivery_category_2_search_detail"
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
                                        id="delivery_category_3_search_detail"
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
                    <table class="table table-bordered table-hover table-striped nowrap" id="table-search-delivery-detail">
                        <thead>
                        <tr class="table-search-head">
                            <th scope="col">納入先コード</th>
                            <th scope="col">納入先名</th>
                            <th scope="col">フリガナ</th>
                            <th scope="col">納入先分類1</th>
                            <th scope="col">納入先分類2</th>
                            <th scope="col">納入先分類3</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnBackSearch" class="btn btn-secondary">戻る</button>
                <button type="button" id="btnSubmitSearch" class="btn btn-primary">検索</button>
            </div>
        </div>
    </div>
</div>
