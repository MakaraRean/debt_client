@extends('template')

@section('content')
    <div id="contentListOfDebt">
        <form action="" method="get" class="form-control mt-3">
            @csrf
            <a href="#searchCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false"
                aria-controls="searchCollapse">
                <img src="{{ asset('images/filter.png') }}" alt="" width="30px" height="25px"> <span>តម្រង</span>
                {{-- <button class="btn-close"></button> --}}
            </a>
            <div class="collapse" id="searchCollapse">
                <div class="row g-2 mt-2">
                    <div class="col-md-6">
                        <div class="col-auto">
                            <label for="d1">ចាប់ពីថ្ងៃទី : </label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="date" name="d1" id="d1">
                        </div>
                        <div class="col-auto">
                            <label for="d1">ដល់ថ្ងៃទី : </label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="date" name="d2" id="d2">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="selectDebt">ប្រភេទបំណុល : </label>
                        <select class="form-select" name="selectDebt" id="selectDebt">
                            <option value="All">ទាំងអស់ (ទូទាត់រួច និង​ មិនទាន់ទូទាត់)</option>
                            <option value="Paid">បានទូទាត់រួចរាល់</option>
                            <option value="Unpaid">មិនទាន់បានទូទាត់</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="search()">ស្វែងរក</button>
                </div>
            </div>
        </form>
        <div class="row g-2 mt-2 mb-2">
            <div class="col-auto">
                <input class="form-control border border-primary" type="search" name="txtSearch" id="txtSearch"
                    placeholder="ឈ្មោះ, ភូមិ, ទឹកប្រាក់, ចំណាំ">
            </div>
            <div class="col-auto">
                <button class="form-control" type="button" onclick="searchTable(txtSearch.value)">ស្វែងរក</button>
            </div>

            <a class="btn" data-bs-toggle="collapse" href="#collapseTotalAmount" role="button" aria-expanded="false"
                aria-controls="collapseTotalAmount">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-primary">
                        ទឹកប្រាក់សរុបទាំងអស់ : <span class="text-primary" id="totalDebtAmount"></span>
                    </li>
                    <div class="collapse" id="collapseTotalAmount">
                        <li class="list-group-item list-group-item-danger">មិនទាន់ទូទាត់ : <span
                                id="unpaidDebtAmount"></span>
                        </li>
                        <li class="list-group-item list-group-item-success">ទូទាត់រួច : <span id="paidDebtAmount"></span>
                        </li>
                    </div>
                </ul>
            </a>
        </div>

        <div id="contentAboveTable" class="d-flex justify-content-center mb-2" style="display: none">
            <div id="loading" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="table-responsive" style="height: 60%">
            <table class="table caption-top table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ល.រ</th>
                        <th>ឈ្មោះ</th>
                        <th>ភេទ</th>
                        <th>អាស័យដ្ឋាន</th>
                        <th>ចំនួនទឹកប្រាក់</th>
                        <th>ចំណាំ</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <nav>
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="mt-5" id="contentNewDebt" style="display: none">
        <form class="form-control" action="#df" method="post">
            @csrf
            <div id="newDebtAlertMessage">

            </div>

            <div class="row">
                <div class="input-group dropdown col-md-5">
                    <span class="input-group-text" id="span-debtor">អ្នកជំពាក់
                        <i class="fa-solid fa-circle-notch fa-spin fa-lg" style="color: #184dec; display: none"
                            id="iconSpinner"></i>
                        <i class="fa-solid fa-check fa-fade fa-lg" style="color: #1ce119; display: none"
                            id="iconCheck"></i>
                        <i class="fa-solid fa-xmark" style="color: #e60000; display: none" id="iconX"></i>
                    </span>
                    <input class="form-control" type="text" name="debtor" id="debtor" placeholder="ឈ្មោះ"
                        aria-describedby="span-debtor" aria-label="Debtor" autocomplete="off"
                        oninput="debtorSuggestion('#dropdownOptions', '#debtor', '#span-debtor')"
                        onfocus="getDebtor_onFocus('#span-debtor', '#dropdownOptions')">
                    <input type="hidden" id="debtorId">
                    <div class="dropdown-menu scrollable mt-5" id="dropdownOptions"
                        style="max-height: 150px; overflow-y: auto"></div>
                </div>

            </div>
            <p class="text-body-secondary" style="font-size: 12px">សរសេរឈ្មោះអ្នកជំពាក់ រួចជ្រើសយកក្នុងបញ្ជីរ
                បើមិនមានក្នុងបញ្ជីរ <a href="" data-bs-toggle="modal"
                    data-bs-target="#newDebtorMedal">សូមបង្កើតថ្មី</a>
            </p>

            <div class="mb-3 input-group">
                <span class="input-group-text" id="span-amount">ចំនួនទឹកប្រាក់</span>
                <input class="form-control" type="number" name="amount" id="amount" aria-describedby="span-amount"
                    placeholder="រៀល" aria-label="amount" inputmode="numeric" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text" id="span-note">ចំណាំ</span>
                <textarea class="form-control" name="txtNote" id="txtNote" aria-describedby="span-note"
                    placeholder="ឩទាហរណ៍ ៖ សាំងធម្មតា 30លីត្រ x 4000 រៀល" aria-label="note" cols="10" rows="3"></textarea>
            </div>

            <button class="btn btn-primary" type="submit" id="addNewDebt" onclick="newDebt_Clicked()" disabled>
                <span id="btnSaveDebtSpinner" class="spinner-border spinner-border-sm" role="status"
                    aria-hidden="true"></span>
                បន្តែម
            </button>
            <!-- Modal -->
            <div class="modal fade" id="newDebtorMedal" tabindex="-1" aria-labelledby="newDebtorMedal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="medalTitle">បង្កើតអ្នកជំពាក់ថ្មី</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form class="form-control" action="" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="input-group">
                                        <span class="input-group-text" id="span-debtor-name">ឈ្មោះអ្នកជំពាក់</span>
                                        <input class="form-control" type="text" name="debtorName" id="debtorName"
                                            aria-describedby="span-debtor-name" placeholder="ឈ្មោះ">
                                    </div>
                                    <div class="input-group mt-3">
                                        <span class="input-group-text" id="span-debtor-address">អាស័យដ្ឋាន</span>
                                        <input class="form-control" type="text" name="debtorAddress"
                                            id="debtorAddress" aria-describedby="span-debtor-address" placeholder="ភូមិ">
                                    </div>
                                    <div class="input-group mt-3">
                                        <select class="form-select" name="debtorSex" id="debtorSex">
                                            <option value="ប្រុស">ប្រុស</option>
                                            <option value="ស្រី">ស្រី</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeMedal"
                                    data-bs-dismiss="modal">បិទ</button>
                                <button id="btnSaveDebtor" type="button" class="btn btn-primary" onclick="newDebtor()">
                                    <span id="btnSaveDebtorSpinner" class="spinner-border spinner-border-sm"
                                        role="status" aria-hidden="true"></span>
                                    <span class="buttom-text" id="btnSaveDebtorText">រក្សាទុក</span>
                                    {{-- Loading... --}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="contentPayDebt" style="display: none">
        <form class="mt-5 form-control row" action="" method="post">
            @csrf
            <div id="payDebtAlertMessage"></div>
            <div class="col-md-6 input-group mb-3 dropdown">
                <span class="input-group-text" id="span-debt">ឈ្មោះអ្នកជំពាក់
                    <i class="fa-solid fa-circle-notch fa-spin fa-lg" style="color: #184dec; display: none"
                        id="iconSpinner"></i>
                    <i class="fa-solid fa-check fa-fade fa-lg" style="color: #1ce119; display: none" id="iconCheck"></i>
                    <i class="fa-solid fa-xmark" style="color: #e60000; display: none" id="iconX"></i>
                </span>
                <input class="form-control" type="text" name="debtorToPay" id="debtorToPay"
                    placeholder="ឈ្មោះ និង ភូមិ" aria-describedby="span-debtor" placeholder="Debtor" aria-label="Debt"
                    autocomplete="off" oninput="debtorSuggestion('#dropdownOptionDebt', '#debtorToPay', '#span-debt')"
                    onfocus="getDebtor_onFocus('#span-debt', '#dropdownOptionDebt')">
                <input type="hidden" id="debtorToPayId">
                <div class="dropdown-menu mt-5" id="dropdownOptionDebt"></div>
            </div>

            <div class="col-md-4 mb-3 input-group">

                <span class="input-group-text" id="span-amount-topay">ទឹកប្រាក់ដែលត្រូវទូទាត់</span>
                <input class="form-control" type="text" id="amountToPay" name="amountToPay"
                    aria-describedby="span-amout-topay" placeholder="រៀល" readonly>
                <div class="input-group-append" id="payDebtSpinner" style="display: none">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3 input-group">
                <span class="input-group-text" id="span-debt-count">ចំនួនវិក័យបត្រដែលជំពាក់</span>
                <input class="form-control" type="text" id="txtDebtCount" name="txtDebtCount"
                    aria-describedby="span-debt-count" placeholder="រិក័យបត្រ" readonly>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="paySomeCheckbox" id="paySomeCheckbox">
                <label class="form-check-label" for="paySomeCheckbox">ចុចត្រង់នេះប្រសិនបើអតិថិជនមកបង់លុយខ្លះ
                    (បង់មិនទាន់ដាច់)</label>
            </div>

            {{-- Pay some content --}}
            <div id="divPaySome" style="display: none">
                <div class="input-group mb-3 dropdown">
                    <span class="input-group-text" id="span-amount-topay">ទឹកប្រាក់ដែលបានបង់</span>
                    <input class="form-control" type="number" name="txtAmountPaySome" id="txtAmountPaySome"
                        placeholder="ទឹកប្រាក់" aria-describedby="span-amount-topay" aria-label="amount-topay"
                        autocomplete="off" inputmode="numeric">
                </div>
                <div class="input-group">
                    <span class="input-group-text" id="span-new-debt-amount">ទឹកប្រាក់ដែលនៅជំពាក់</span>
                    <input class="form-control" type="text" name="txtNewDebtAmount" id="txtNewDebtAmount"
                        placeholder="ទឹកប្រាក់ដែលនៅជំពាក់" aria-describedby="span-new-debt-amount"
                        aria-label="new-debt-amount" readonly>
                </div>
            </div>
            <button class="mt-3 col btn btn-primary" id="btnPay" type="button" disabled data-bs-toggle="modal"
                data-bs-target="#payDebtMedal">Pay</button>
        </form>

        {{-- Modal --}}
        <div class="modal fade" id="payDebtMedal" tabindex="-1" aria-labelledby="payDebtMedal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="payMedalTitle">title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>បើសិនជាអតិថិជនបានទូទាត់រួចសូមចុច បាទ/ចាស។ បើសិនអតិថិជនមិនទាន់បានទូទាត់សូមចុច ទេ</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closePayMedal"
                            data-bs-dismiss="modal">ទេ</button>
                        <button id="btnPayDebt" type="button" class="btn btn-primary">
                            <span id="btnPayDebtSpinner" class="spinner-border spinner-border-sm" role="status"
                                style="display: none" aria-hidden="true"></span>
                            <span class="buttom-text" id="btnPayDebtText">បាទ/ចាស</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
