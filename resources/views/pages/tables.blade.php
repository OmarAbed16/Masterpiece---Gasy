<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Drivers</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Driver name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Phone</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    governorate</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Creation Date</th>

                                                    <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    View</th>

                                                    <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Truck details</th>

                                                    <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Edit</th>

                                                    <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($drivers as $driver)
<tr>
    <td>
        <div class="d-flex px-2 py-1">
            <div>
                <img src="{{ asset('assets') }}/img/images/{{ $driver->profile_image }}"
                    class="avatar avatar-sm me-3 border-radius-lg"
                    alt="user1">
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">{{ $driver->name }}</h6>
                <p class="text-xs text-secondary mb-0">{{ $driver->email }}</p>
            </div>
        </div>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0">{{ $driver->phone }}</p>
    </td>
    <td class="align-middle text-center text-sm">
        <p class="text-xs font-weight-bold mb-0">{{ $driver->governorate }}</p>
    </td>
    <td class="align-middle text-center">
        <span class="text-secondary text-xs font-weight-bold">{{ $driver->created_at }}</span>
    </td>
    
    <!-- Visibility Button -->
    <td class="text-center">
        <button type="button" class="btn btn-secondary btn-link view-driver"
            data-name="{{ $driver->name }}"
            data-national-number="{{ $driver->national_number }}"
            data-national-number-image="{{ asset('assets/img/images/' . $driver->national_number_image) }}"
            data-driver-license-image="{{ asset('assets/img/images/' . $driver->driver_license_image) }}"
            data-gas-license-image="{{ asset('assets/img/images/' . $driver->gas_license_image) }}">
            <i class="material-icons">visibility</i>
        </button>
    </td>


    <!-- Truck Info Button -->
    <td class="text-center">
    <button type="button" class="btn btn-primary btn-link truck-info"
        data-id="{{ $driver->id }}" 
        data-license="{{ $driver->truck_license_plate }}"
        data-company="{{ $driver->company }}"
        data-capacity="{{ $driver->truck_capacity }}"
        data-load="{{ $driver->truck_load }}"
        data-status="{{ $driver->truck_status }}"
        title="View Truck Info">
        <i class="material-icons">directions_car</i>
    </button>
</td>


    <!-- Edit Button -->
    <td class="text-center">
        <a rel="tooltip" class="btn btn-success btn-link" href="" title="Edit">
            <i class="material-icons">edit</i>
        </a>
    </td>

    <!-- Delete Button -->
    <td class="text-center">
    <button type="button" class="btn btn-danger btn-link delete-driver"
        data-id="{{ $driver->user_id }}" title="Delete">
        <i class="material-icons">close</i>
    </button>
</td>
</tr>
@endforeach

                                           
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Projects table</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Project</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Budget</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Status</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                    Completion</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/logo-asana.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="spotify">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Asana</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$2,500</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">working</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">60%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="60"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 60%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/github.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="invision">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Github</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$5,000</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">done</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">100%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-success"
                                                                    role="progressbar" aria-valuenow="100"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/logo-atlassian.svg"
                                                                class="avatar avatar-sm rounded-circle me-2" alt="jira">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Atlassian</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$3,400</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">canceled</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">30%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-danger"
                                                                    role="progressbar" aria-valuenow="30"
                                                                    aria-valuemin="0" aria-valuemax="30"
                                                                    style="width: 30%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/bootstrap.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="webdev">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Bootstrap</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$14,000</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">working</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">80%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-info"
                                                                    role="progressbar" aria-valuenow="80"
                                                                    aria-valuemin="0" aria-valuemax="80"
                                                                    style="width: 80%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/logo-slack.svg"
                                                                class="avatar avatar-sm rounded-circle me-2"
                                                                alt="slack">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Slack</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$1,000</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">canceled</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">0%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-success"
                                                                    role="progressbar" aria-valuenow="0"
                                                                    aria-valuemin="0" aria-valuemax="0"
                                                                    style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                        <div>
                                                            <img src="{{ asset('assets') }}/img/small-logos/devto.svg"
                                                                class="avatar avatar-sm rounded-circle me-2" alt="xd">
                                                        </div>
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">Devto</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">$2,300</p>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">done</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span class="me-2 text-xs font-weight-bold">100%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-gradient-success"
                                                                    role="progressbar" aria-valuenow="100"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: 100%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-link text-secondary mb-0"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Add event listener for "visibility" buttons
    document.querySelectorAll('.view-driver').forEach(button => {
        button.addEventListener('click', function () {
            // Retrieve driver data from data attributes
            const name = this.getAttribute('data-name');
            const nationalNumber = this.getAttribute('data-national-number');
            const nationalNumberImage = this.getAttribute('data-national-number-image');
            const driverLicenseImage = this.getAttribute('data-driver-license-image');
            const gasLicenseImage = this.getAttribute('data-gas-license-image');

            // Display data in SweetAlert modal
            Swal.fire({
                title: 'Driver Details',
                html: `
                <p>
                        <img src="{{ asset('assets') }}/img/images/{{ $driver->profile_image }}" alt="National Number" style="max-width: 100%; height: auto; border-radius: 5px;">
                    </p>

                    <p><strong>Name:</strong> ${name}</p>
                    <p><strong>National Number:</strong> ${nationalNumber}</p>
                     
                    <p><strong>National Number Image:</strong><br>
                        <img src="{{ asset('assets') }}/img/images/${nationalNumberImage}" alt="National Number" style="max-width: 100%; height: auto; border-radius: 5px;">
                    </p>
                    <p><strong>Driver License Image:</strong><br>
                        <img src="${driverLicenseImage}" alt="Driver License" style="max-width: 100%; height: auto; border-radius: 5px;">
                    </p>
                    <p><strong>Gas License Image:</strong><br>
                        <img src="${gasLicenseImage}" alt="Gas License" style="max-width: 100%; height: auto; border-radius: 5px;">
                    </p>
                `,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        });
    });


    document.querySelectorAll('.truck-info').forEach(button => {
        button.addEventListener('click', function () {
            // Get data attributes from the button
            const driverId = this.getAttribute('data-id');
            const licensePlate = this.getAttribute('data-license');
            const companyName = this.getAttribute('data-company');
            const truckCapacity = this.getAttribute('data-capacity');
            const truckLoad = this.getAttribute('data-load');
            const truckStatus = this.getAttribute('data-status');

            // Display truck details using SweetAlert2
            Swal.fire({
                title: 'Truck Details',
                html: `
                    <strong>License Plate:</strong> ${licensePlate} <br>
                    <strong>Company Name:</strong> ${companyName} <br>
                    <strong>Capacity:</strong> ${truckCapacity} tons <br>
                    <strong>Current Load:</strong> ${truckLoad} tons <br>
                    <strong>Status:</strong> ${truckStatus} <br>
                `,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        });
    });



    document.querySelectorAll('.delete-driver').forEach(button => {
    button.addEventListener('click', function () {
        const driverId = this.getAttribute('data-id'); // Get driver ID

        // Show confirmation popup with SweetAlert2
        Swal.fire({
            title: 'Are you sure?',
            text: "This driver will be deleted and cannot be restored!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                // Proceed with the DELETE request if confirmed

                // Send DELETE request using fetch
                fetch(`/drivers/d/${driverId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())  // Handle JSON response
                .then(data => {
                    if (data.success) {
                        // Show success SweetAlert
                        Swal.fire('Deleted!', 'The driver has been deleted.', 'success');
                        // Optionally reload the page to reflect the deletion
                        setTimeout(function() {
    location.reload(); 
}, 1000); 

                    } else {
                        // Show error SweetAlert if deletion fails
                        Swal.fire('Error!', 'There was an issue deleting the driver.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle errors if the fetch request fails
                    Swal.fire('Error!', 'Something went wrong. Please try again later.', 'error');
                });
            }
        });
    });
});



</script>


</x-layout>
