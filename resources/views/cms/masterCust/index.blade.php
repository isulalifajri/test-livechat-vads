@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h4 class="mb-1">
                            Master Customer
                        </h4>

                        <p class="text-muted mb-0">
                            Data customer from Random User API
                        </p>

                    </div>

                    <button
                        class="btn btn-primary"
                        onclick="loadCustomers()">

                        Reload Data

                    </button>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered align-middle datatables-basic table-hover table-striped">

                        <thead>

                            <tr>

                                <th>Name</th>
                                <th>Email</th>
                                <th>Login - UUID</th>
                                <th>Login - Username</th>
                                <th>Login - Password</th>
                                <th>Phone</th>
                                <th>Cell</th>
                                <th>Picture</th>

                            </tr>

                        </thead>

                        <tbody id="customerTable">

                            <tr>

                                <td colspan="8" class="text-center">

                                    Loading...

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('js')

<script>

    async function loadCustomers() {

        try {

            const response = await fetch(
                `/master/customer/data`
            );

            const data = await response.json();

            let html = '';

            data.results.forEach(item => {

                html += `
                    <tr>

                        <td>
                            ${item.name}
                        </td>

                        <td>
                            ${item.email}
                        </td>

                        <td>
                            <small>${item.login.uuid}</small>
                        </td>

                        <td>
                            ${item.login.username}
                        </td>

                        <td>
                            ${item.login.password}
                        </td>

                        <td>
                            ${item.phone}
                        </td>

                        <td>
                            ${item.cell}
                        </td>

                        <td>

                            <img
                                src="${item.picture.medium}"
                                class="rounded"
                                width="50">

                        </td>

                    </tr>
                `;

            });

            document.getElementById(
                'customerTable'
            ).innerHTML = html;

        } catch(error) {

            console.log(error);

        }
    }

    loadCustomers();

</script>

@endpush