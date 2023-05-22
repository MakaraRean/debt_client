@extends('template')

@section('content')
    <div id="contentListOfDebt">
        <form action="" method="get" class="form-control mt-3">
            @csrf
            <a href="#searchCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false"
                aria-controls="searchCollapse">
                {{-- <img src="{{ asset('images/search.png') }}" alt="" width="20px" height="20px"> --}}
                <button class="btn-close"></button>
            </a>
            <div class="collapse" id="searchCollapse">
                <div class="row g-2 mt-2">
                    <div class="col-md-6">
                        <div class="col-auto">
                            <label for="d1">From : </label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="date" name="d1" id="d1">
                        </div>
                        <div class="col-auto">
                            <label for="d1">To : </label>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="date" name="d2" id="d2">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="selectDebt">Select Debts : </label>
                        <select class="form-select" name="selectDebt" id="selectDebt">
                            <option value="All Debts">All debts</option>
                            <option value="Paid only">Paid only</option>
                            <option value="Not pay yet only">Not pay yet only</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
        <div class="row g-2 mt-2 mb-2">
            <div class="col-auto">
                <input class="form-control border border-primary" type="search" name="txtSearch" id="txtSearch">
            </div>
            <div class="col-auto">
                <button class="form-control" type="submit">Search</button>
            </div>
        </div>

        <table class="table caption-top table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Address</th>
                    <th>Debt</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <tr id="loadingSpinner" style="display: none">
                    <th>
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </th>
                </tr>
                {{-- <tr class="table-success text-decoration-line-through">
                    <th>01</th>
                    <th><s>Makara</s></th>
                    <th>Male</th>
                    <th>Phnom Penh</th>
                    <th>10000</th>
                </tr>
                <tr class="table-warning">
                    <th>01</th>
                    <th>Makara</th>
                    <th>Male</th>
                    <th>Phnom Penh</th>
                    <th>10000</th>
                </tr> --}}
            </tbody>
        </table>

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
            <div class="mb-3 input-group">
                <span class="input-group-text" id="span-amount">ចំនួនទឹកប្រាក់</span>
                <input class="form-control" type="number" name="amount" id="amount" aria-describedby="span-amount"
                    placeholder="រៀល" aria-label="amount" inputmode="numeric" required>
            </div>
            <div class="input-group dropdown">
                <span class="input-group-text" id="span-debtor">អ្នកជំពាក់</span>
                <input class="form-control" type="text" name="debtor" id="debtor" placeholder="ឈ្មោះ"
                    aria-describedby="span-debtor" aria-label="Debtor" autocomplete="off" oninput="debtorSuggestion()"
                    onfocus="getDebtor_onFocus()">
                <input type="hidden" id="debtorId">
                <div class="dropdown-menu mt-5" id="dropdownOptions"></div>
            </div>
            <p class="text-body-secondary" style="font-size: 12px">សរសេរឈ្មោះអ្នកជំពាក់ រួចជ្រើសយកក្នុងបញ្ជីរ
                បើមិនមានក្នុងបញ្ជីរ <a href="" data-bs-toggle="modal"
                    data-bs-target="#newDebtorMedal">សូមបង្កើតថ្មី</a></p>
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
            <div class="col-md-6 input-group mb-3 dropdown">
                <span class="input-group-text" id="span-debt">Debt</span>
                <input class="form-control" type="text" name="debt" id="debt" placeholder="debt"
                    aria-describedby="span-debtor" placeholder="Debt" aria-label="Debt" autocomplete="off"
                    oninput="debtSuggestion()">
                <div class="dropdown-menu mt-5" id="dropdownOptionDebt"></div>
            </div>

            <div class="col-md-6 mb-3 input-group">
                <span class="input-group-text" id="span-amount-topay">Amount to pay</span>
                <input class="form-control" type="text" id="amountToPay" name="amountToPay"
                    aria-describedby="span-amout-topay" value="10000" disabled>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="paySomeCheckbox" id="paySomeCheckbox">
                <label class="form-check-label" for="paySomeCheckbox">Check this if debtor pay some</label>
            </div>

            {{-- Pay some content --}}
            <div id="divPaySome" class="input-group mb-3 dropdown" style="display: none">
                <span class="input-group-text" id="span-topay">Amount to pay</span>
                <input class="form-control" type="text" name="topay" id="topay" placeholder="topay"
                    aria-describedby="span-topay" placeholder="topay" aria-label="topay" autocomplete="off">
            </div>
            <button class="mt-3 col btn btn-primary" type="submit">Pay</button>
        </form>
    </div>
@endsection
