<div class="col-sm-auto bg-grey sticky-top sidebarstyle">
    <div
        class="d-flex flex-sm-column flex-row flex-nowrap bg-grey align-items-center sticky-top"
    >
        <ul
            class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center avtive-style"
        >
            <li class="nav-item sidebar-item-custom">
                <a
                    href="javascript:void(0)"
                    class="nav-link py-3"
                >
                    <i class="fa-regular fa-envelope color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >お知らせ</span
                    >
                </a>
            </li>

            <li class="nav-item sidebar-item-custom">
                <a
                    href="javascript:void(0)"
                    class="nav-link py-3"
                >
                    <i class="fa-solid fa-calendar-days color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >シフト</span
                    >
                </a>
            </li>
            <li class="nav-item sidebar-item-custom">
                <a
                    href="javascript:void(0)"
                    class="nav-link py-3"
                >
                    <i class="fa-solid fa-barcode color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >
                    在庫</span
                    >
                </a>
            </li>
            <li class="nav-item sidebar-item-custom">
                <a
                    href="javascript:void(0)"
                    class="nav-link py-3"
                >
                    <i class="fa-solid fa-file-invoice-dollar color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >
                    ハンディ</span
                    >
                </a>
            </li>
            <li class="nav-item sidebar-item-custom">
                <a
                    href="javascript:void(0)"
                    class="nav-link py-3"
                >
                    <i class="fa-thin fa-arrow-trend-up color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >
                    売上</span
                    >
                </a>
            </li>
            <li class="nav-item sidebar-item-custom">
                <a
                    href="javascript:void(0)"
                    class="nav-link py-3"
                >
                    <i class="fa-solid fa-box color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >
                    仕入</span
                    >
                </a>
            </li>
            <li class="nav-item sidebar-item-custom" id="deliveryDetailItemSidebar">
                <a
                    href="{{route('deliveryDetail')}}"
                    class="nav-link py-3 {{request()->is('delivery-detail') ? 'active' : ''}}"
                >
                    <i class="fa-solid fa-upload color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >データ出力</span
                    >
                </a>
            </li>
            <li class="nav-item sidebar-item-custom">
                <a
                    id="searchTab"
                    href="{{route('deliverySearch')}}"
                    class="nav-link py-3 {{request()->is('delivery-search') ? 'active' : ''}}"
                >
                    <i class="fa-solid fa-star color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >マスター</span
                    >
                </a>
            </li>
            <li class="nav-item sidebar-item-custom">
                <a
                    href="javascript:void(0)"
                    class="nav-link py-3"
                >
                    <i class="fa-solid fa-gears color-navlink-custom"></i>
                    <span class="name-sidebar-item color-navlink-custom"
                    >設定</span
                    >
                </a>
            </li>
        </ul>
    </div>
</div>
