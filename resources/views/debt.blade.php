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
                            <option value="All Debts">Paid only</option>
                            <option value="All Debts">Not pay yet only</option>
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
        <form class="form-control" action="" method="post">
            @csrf
            <div class="mb-3 input-group">
                <span class="input-group-text" id="span-amount">Amount</span>
                <input class="form-control" type="text" name="amount" id="amount" aria-describedby="span-amount"
                    placeholder="Amount" aria-label="amount">
            </div>
            <div class="input-group mb-3 dropdown">
                <span class="input-group-text" id="span-debtor">Debtor</span>
                <input class="form-control" type="text" name="debtor" id="debtor" placeholder="debtor"
                    aria-describedby="span-debtor" placeholder="Debtor" aria-label="Debtor" autocomplete="off"
                    oninput="debtorSuggestion()">
                <input type="text" id="debtorId">
                <div class="dropdown-menu mt-5" id="dropdownOptions"></div>
            </div>
            <button class="btn btn-primary" type="submit">Add new</button>
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
