@extends('backend.layouts.app')

@section('title', $title ?? __('Role'))

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="bs-stepper vertical wizard-vertical-icons-example mt-2">
                        <div class="bs-stepper-header">
                            <div class="step" data-target="#system-info">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">
                                        <i class="fa-regular fa-file-lines"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">System Info</span>
                                        <span class="bs-stepper-subtitle">Setup System Info</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#site-logo">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">
                                        <i class="fa-regular fa-circle-user"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Site Logo</span>
                                        <span class="bs-stepper-subtitle">Add site logo</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#social-links">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle">
                                        <i class="fa-solid fa-share-nodes"></i>
                                    </span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Social Links</span>
                                        <span class="bs-stepper-subtitle">Add official social links</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <!-- Account Details -->
                            <div id="system-info" class="content">
                                <form
                                    action="{{ route('settings.update', ['id' => $settings['settings']->id, 'type' => 'system']) }}"
                                    method="post">
                                    @csrf
                                    <div class="content-header mb-3">
                                        <h6 class="mb-0">Basic System Info</h6>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label class="form-label" for="name">Site Name</label>
                                            <input type="text" id="name" name="site_name"
                                                value="{{ $settings['settings']->site_name }}" class="form-control"
                                                placeholder="Site Name" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" for="site_title">Site Title</label>
                                            <input type="text" id="site_title" name="site_title"
                                                value="{{ $settings['settings']->site_title }}" class="form-control"
                                                placeholder="Site Title" aria-label="Site Title" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" for="contact_number">Contact Number</label>
                                            <input type="text" id="contact_number" name="contact_number"
                                                value="{{ $settings['settings']->contact_number }}" class="form-control"
                                                placeholder="Contact Number" aria-label="john.doe" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label" for="email">Email Address</label>
                                            <input type="text" id="email" name="email"
                                                value="{{ $settings['settings']->email }}" class="form-control"
                                                placeholder="Email Address" aria-label="john.doe" />
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="content-header mb-3">
                                        <h6 class="mb-0">Other's Info</h6>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <label class="form-label" for="timezone">Time Zone</label>
                                            <select class="select2 form-select" id="timezone" name="timezone" aria-label="Time Zone"
                                                value="{{ $settings['settings']->timezone }}">
                                                @foreach ($timezones as $key => $timezone)
                                                        <option
                                                            value="{{ $timezone['zone'] . ' ' . $timezone['gmt'] }}">
                                                            {{ $timezone['zone'] . ' ' . $timezone['gmt'] }}
                                                        </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label" for="date_format">Date Format</label>
                                            <select class="select2 form-select" id="date_format" name="date_format" aria-label="Date Format"
                                                value="{{ $settings['settings']->date_format }}">
                                                @foreach ($dateFormats as $key => $dateFormat)
                                                        <option
                                                            value="{{ $dateFormat['format'] }}">
                                                            {{ $dateFormat['format'] }}
                                                        </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label" for="currency">Currency</label>
                                            <input type="text" id="currency" class="form-control" name="currency"
                                                value="{{ $settings['settings']->currency }}" placeholder="john.doe"
                                                aria-label="john.doe" />
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label" for="address">Address</label>
                                            <input type="text" id="address" class="form-control" name="address"
                                                value="{{ $settings['settings']->address }}" name="address" placeholder="john.doe"
                                                aria-label="john.doe" />
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label" for="map_location">Map Location <small
                                                    class="text-body-secondary">(Location get from <a target="_blank"
                                                        href="https://www.google.com/maps">Google
                                                        Map</a>)</span></label>
                                            <input type="text" id="map_location" class="form-control"
                                                value="{{ $settings['settings']->map_location }}" name="map_location" placeholder="john.doe"
                                                aria-label="john.doe" />
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label" for="copyright">Copy Right Info</label>
                                            <input type="text" id="copyright" class="form-control"
                                                value="{{ $settings['settings']->copyright }}" name="copyright" placeholder="john.doe"
                                                aria-label="john.doe" />
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-3">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-1">Save</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Personal Info -->
                            <div id="site-logo" class="content">
                                <div class="content-header mb-3">
                                    <h6 class="mb-0">Personal Info</h6>
                                    <small>Enter Your Personal Info.</small>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="first-name1">First Name</label>
                                        <input type="text" id="first-name1" class="form-control"
                                            placeholder="John" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="last-name1">Last Name</label>
                                        <input type="text" id="last-name1" class="form-control" placeholder="Doe" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="country1">Country</label>
                                        <select class="select2" id="country1">
                                            <option label=" "></option>
                                            <option>UK</option>
                                            <option>USA</option>
                                            <option>Spain</option>
                                            <option>France</option>
                                            <option>Italy</option>
                                            <option>Australia</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="language1">Language</label>
                                        <select class="selectpicker w-auto" id="language1" data-style="btn-default"
                                            data-icon-base="ti" data-tick-icon="ti-check text-white" multiple>
                                            <option>English</option>
                                            <option>French</option>
                                            <option>Spanish</option>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="ti ti-arrow-left me-sm-1"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-primary btn-next">
                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                            <i class="ti ti-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Social Links -->
                            <div id="social-links" class="content">
                                <div class="content-header mb-3">
                                    <h6 class="mb-0">Social Links</h6>
                                    <small>Enter Your Social Links.</small>
                                </div>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="twitter1">Twitter</label>
                                        <input type="text" id="twitter1" class="form-control"
                                            placeholder="https://twitter.com/abc" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="facebook1">Facebook</label>
                                        <input type="text" id="facebook1" class="form-control"
                                            placeholder="https://facebook.com/abc" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="google1">Google+</label>
                                        <input type="text" id="google1" class="form-control"
                                            placeholder="https://plus.google.com/abc" />
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="linkedin1">Linkedin</label>
                                        <input type="text" id="linkedin1" class="form-control"
                                            placeholder="https://linkedin.com/abc" />
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-label-secondary btn-prev">
                                            <i class="ti ti-arrow-left me-sm-1"></i>
                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                        </button>
                                        <button class="btn btn-success btn-submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/form-wizard-icons.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script type="text/javascript"></script>
@endpush
