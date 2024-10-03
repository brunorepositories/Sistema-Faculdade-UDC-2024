@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

{{-- @section('content')
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Basic Layout</h5> <small class="text-body float-end">Default label</small>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-fullname">Full Name</label>
                                    <input type="text" class="form-control" id="basic-default-fullname"
                                        placeholder="John Doe">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-company">Company</label>
                                    <input type="text" class="form-control" id="basic-default-company"
                                        placeholder="ACME Inc.">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="basic-default-email" class="form-control"
                                            placeholder="john.doe" aria-label="john.doe"
                                            aria-describedby="basic-default-email2">
                                        <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                    </div>
                                    <div class="form-text"> You can use letters, numbers &amp; periods </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-phone">Phone No</label>
                                    <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                        placeholder="658 799 8941">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-message">Message</label>
                                    <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Basic with Icons</h5>
                            <small class="text-muted float-end">Merged input group</small>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            placeholder="John Doe" aria-label="John Doe"
                                            aria-describedby="basic-icon-default-fullname2">
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-icon-default-company">Company</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input type="text" id="basic-icon-default-company" class="form-control"
                                            placeholder="ACME Inc." aria-label="ACME Inc."
                                            aria-describedby="basic-icon-default-company2">
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-icon-default-email">Email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                        <input type="text" id="basic-icon-default-email" class="form-control"
                                            placeholder="john.doe" aria-label="john.doe"
                                            aria-describedby="basic-icon-default-email2">
                                        <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                                    </div>
                                    <div class="form-text"> You can use letters, numbers &amp; periods </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="bx bx-phone"></i></span>
                                        <input type="text" id="basic-icon-default-phone"
                                            class="form-control phone-mask" placeholder="658 799 8941"
                                            aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2">
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-icon-default-message">Message</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-message2" class="input-group-text"><i
                                                class="bx bx-comment"></i></span>
                                        <textarea id="basic-icon-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                            aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Multi Column with Form Separator -->
            <div class="card mb-6">
                <h5 class="card-header">Multi Column with Form Separator</h5>
                <form class="card-body">
                    <h6>1. Account Details</h6>
                    <div class="row g-6">
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-username">Username</label>
                            <input type="text" id="multicol-username" class="form-control" placeholder="john.doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-email">Email</label>
                            <div class="input-group input-group-merge">
                                <input type="text" id="multicol-email" class="form-control" placeholder="john.doe"
                                    aria-label="john.doe" aria-describedby="multicol-email2">
                                <span class="input-group-text" id="multicol-email2">@example.com</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-password-toggle">
                                <label class="form-label" for="multicol-password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="multicol-password" class="form-control"
                                        placeholder="············" aria-describedby="multicol-password2">
                                    <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                            class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-password-toggle">
                                <label class="form-label" for="multicol-confirm-password">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="multicol-confirm-password" class="form-control"
                                        placeholder="············" aria-describedby="multicol-confirm-password2">
                                    <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i
                                            class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-6 mx-n6">
                    <h6>2. Personal Info</h6>
                    <div class="row g-6">
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-first-name">First Name</label>
                            <input type="text" id="multicol-first-name" class="form-control" placeholder="John">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-last-name">Last Name</label>
                            <input type="text" id="multicol-last-name" class="form-control" placeholder="Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-country">Country</label>
                            <div class="position-relative"><select id="multicol-country"
                                    class="select2 form-select select2-hidden-accessible" data-allow-clear="true"
                                    data-select2-id="multicol-country" tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="2">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    data-select2-id="1" style="width: 658px;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false"
                                            aria-labelledby="select2-multicol-country-container"><span
                                                class="select2-selection__rendered"
                                                id="select2-multicol-country-container" role="textbox"
                                                aria-readonly="true"><span class="select2-selection__placeholder">Select
                                                    value</span></span><span class="select2-selection__arrow"
                                                role="presentation"><b role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                        </div>
                        <div class="col-md-6 select2-primary">
                            <label class="form-label" for="multicol-language">Language</label>
                            <div class="position-relative"><select id="multicol-language"
                                    class="select2 form-select select2-hidden-accessible" multiple=""
                                    data-select2-id="multicol-language" tabindex="-1" aria-hidden="true">
                                    <option value="en" selected="" data-select2-id="4">English</option>
                                    <option value="fr" selected="" data-select2-id="5">French</option>
                                    <option value="de">German</option>
                                    <option value="pt">Portuguese</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    data-select2-id="3" style="width: 658px;"><span class="selection"><span
                                            class="select2-selection select2-selection--multiple" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="-1"
                                            aria-disabled="false">
                                            <ul class="select2-selection__rendered">
                                                <li class="select2-selection__choice" title="English"
                                                    data-select2-id="6"><span class="select2-selection__choice__remove"
                                                        role="presentation">×</span>English</li>
                                                <li class="select2-selection__choice" title="French" data-select2-id="7">
                                                    <span class="select2-selection__choice__remove"
                                                        role="presentation">×</span>French
                                                </li>
                                                <li class="select2-search select2-search--inline"><input
                                                        class="select2-search__field" type="search" tabindex="0"
                                                        autocomplete="off" autocorrect="off" autocapitalize="none"
                                                        spellcheck="false" role="searchbox" aria-autocomplete="list"
                                                        placeholder="" style="width: 0.75em;"></li>
                                            </ul>
                                        </span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-birthdate">Birth Date</label>
                            <input type="text" id="multicol-birthdate" class="form-control dob-picker flatpickr-input"
                                placeholder="YYYY-MM-DD" readonly="readonly">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="multicol-phone">Phone No</label>
                            <input type="text" id="multicol-phone" class="form-control phone-mask"
                                placeholder="658 799 8941" aria-label="658 799 8941">
                        </div>
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="btn btn-primary me-3">Submit</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Collapsible Section -->
            <div class="row my-6">
                <div class="col">
                    <h6> Collapsible Section </h6>
                    <div class="accordion" id="collapsibleSection">
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingDeliveryAddress">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseDeliveryAddress" aria-expanded="false"
                                    aria-controls="collapseDeliveryAddress"> Delivery Address </button>
                            </h2>
                            <div id="collapseDeliveryAddress" class="accordion-collapse collapse"
                                data-bs-parent="#collapsibleSection" style="">
                                <div class="accordion-body">
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label class="form-label" for="collapsible-fullname">Full Name</label>
                                            <input type="text" id="collapsible-fullname" class="form-control"
                                                placeholder="John Doe">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="collapsible-phone">Phone No</label>
                                            <input type="text" id="collapsible-phone" class="form-control phone-mask"
                                                placeholder="658 799 8941" aria-label="658 799 8941">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="collapsible-address">Address</label>
                                            <textarea name="collapsible-address" class="form-control" id="collapsible-address" rows="2"
                                                placeholder="1456, Mall Road"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="collapsible-pincode">Pincode</label>
                                            <input type="text" id="collapsible-pincode" class="form-control"
                                                placeholder="658468">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="collapsible-landmark">Landmark</label>
                                            <input type="text" id="collapsible-landmark" class="form-control"
                                                placeholder="Nr. Wall Street">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="collapsible-city">City</label>
                                            <input type="text" id="collapsible-city" class="form-control"
                                                placeholder="Jackson">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="collapsible-state">State</label>
                                            <div class="position-relative"><select id="collapsible-state"
                                                    class="select2 form-select select2-hidden-accessible"
                                                    data-allow-clear="true" data-select2-id="collapsible-state"
                                                    tabindex="-1" aria-hidden="true">
                                                    <option value="" data-select2-id="9">Select</option>
                                                    <option value="AL">Alabama</option>
                                                    <option value="AK">Alaska</option>
                                                    <option value="AZ">Arizona</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="CA">California</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="DC">District Of Columbia</option>
                                                    <option value="FL">Florida</option>
                                                    <option value="GA">Georgia</option>
                                                    <option value="HI">Hawaii</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="IL">Illinois</option>
                                                    <option value="IN">Indiana</option>
                                                    <option value="IA">Iowa</option>
                                                    <option value="KS">Kansas</option>
                                                    <option value="KY">Kentucky</option>
                                                    <option value="LA">Louisiana</option>
                                                    <option value="ME">Maine</option>
                                                    <option value="MD">Maryland</option>
                                                    <option value="MA">Massachusetts</option>
                                                    <option value="MI">Michigan</option>
                                                    <option value="MN">Minnesota</option>
                                                    <option value="MS">Mississippi</option>
                                                    <option value="MO">Missouri</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="NH">New Hampshire</option>
                                                    <option value="NJ">New Jersey</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="NY">New York</option>
                                                    <option value="NC">North Carolina</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="OH">Ohio</option>
                                                    <option value="OK">Oklahoma</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="PA">Pennsylvania</option>
                                                    <option value="RI">Rhode Island</option>
                                                    <option value="SC">South Carolina</option>
                                                    <option value="SD">South Dakota</option>
                                                    <option value="TN">Tennessee</option>
                                                    <option value="TX">Texas</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="VT">Vermont</option>
                                                    <option value="VA">Virginia</option>
                                                    <option value="WA">Washington</option>
                                                    <option value="WV">West Virginia</option>
                                                    <option value="WI">Wisconsin</option>
                                                    <option value="WY">Wyoming</option>
                                                </select><span class="select2 select2-container select2-container--default"
                                                    dir="ltr" data-select2-id="8" style="width: 660px;"><span
                                                        class="selection"><span
                                                            class="select2-selection select2-selection--single"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-collapsible-state-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-collapsible-state-container" role="textbox"
                                                                aria-readonly="true"><span
                                                                    class="select2-selection__placeholder">Select
                                                                    value</span></span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                        </div>

                                        <label class="form-check-label">Address Type</label>
                                        <div class="col mt-2">
                                            <div class="form-check form-check-inline">
                                                <input name="collapsible-address-type" class="form-check-input"
                                                    type="radio" value="" id="collapsible-address-type-home"
                                                    checked="">
                                                <label class="form-check-label" for="collapsible-address-type-home">Home
                                                    (All day delivery)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="collapsible-address-type" class="form-check-input"
                                                    type="radio" value="" id="collapsible-address-type-office">
                                                <label class="form-check-label" for="collapsible-address-type-office">
                                                    Office (Delivery between 10 AM - 5 PM) </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingDeliveryOptions">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseDeliveryOptions" aria-expanded="false"
                                    aria-controls="collapseDeliveryOptions"> Delivery Options </button>
                            </h2>
                            <div id="collapseDeliveryOptions" class="accordion-collapse collapse"
                                aria-labelledby="headingDeliveryOptions" data-bs-parent="#collapsibleSection"
                                style="">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md mb-md-0 mb-2">
                                            <div class="form-check custom-option custom-option-basic checked">
                                                <label class="form-check-label custom-option-content" for="radioStandard">
                                                    <input name="CustomRadioDelivery" class="form-check-input"
                                                        type="radio" value="" id="radioStandard" checked="">
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Standard 3-5 Days</span>
                                                        <span class="text-muted">Free</span>
                                                    </span>
                                                    <span class="custom-option-body">
                                                        <small> Friday, 15 Nov - Monday, 18 Nov </small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md mb-md-0 mb-2">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="radioExpress">
                                                    <input name="CustomRadioDelivery" class="form-check-input"
                                                        type="radio" value="" id="radioExpress">
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Express</span>
                                                        <span class="text-muted">$5.00</span>
                                                    </span>
                                                    <span class="custom-option-body">
                                                        <small> Friday, 15 Nov - Sunday, 17 Nov </small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content"
                                                    for="radioOvernight">
                                                    <input name="CustomRadioDelivery" class="form-check-input"
                                                        type="radio" value="" id="radioOvernight">
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Overnight</span>
                                                        <span class="text-muted">$10.00</span>
                                                    </span>
                                                    <span class="custom-option-body">
                                                        <small>Friday, 15 Nov - Saturday, 16 Nov</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingPaymentMethod">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePaymentMethod" aria-expanded="false"
                                    aria-controls="collapsePaymentMethod"> Payment Method </button>
                            </h2>
                            <div id="collapsePaymentMethod" class="accordion-collapse collapse"
                                aria-labelledby="headingPaymentMethod" data-bs-parent="#collapsibleSection">
                                <form>
                                    <div class="accordion-body">
                                        <div class="mb-6">
                                            <div class="form-check form-check-inline">
                                                <input name="collapsible-payment"
                                                    class="form-check-input form-check-input-payment" type="radio"
                                                    value="credit-card" id="collapsible-payment-cc" checked="">
                                                <label class="form-check-label" for="collapsible-payment-cc">
                                                    Credit/Debit/ATM Card <i class="bx bx-credit-card-alt"></i>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="collapsible-payment"
                                                    class="form-check-input form-check-input-payment" type="radio"
                                                    value="cash" id="collapsible-payment-cash">
                                                <label class="form-check-label" for="collapsible-payment-cash">
                                                    Cash On Delivery
                                                    <i class="bx bx-help-circle" data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        aria-label="You can pay once you receive the product."
                                                        data-bs-original-title="You can pay once you receive the product."></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div id="form-credit-card" class="row">
                                            <div class="col-12 col-md-8 col-xl-6">
                                                <div class="mb-6">
                                                    <label class="form-label w-100" for="creditCardMask">Card
                                                        Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" id="creditCardMask" name="creditCardMask"
                                                            class="form-control credit-card-mask"
                                                            placeholder="1356 3215 6548 7898"
                                                            aria-describedby="creditCardMask2">
                                                        <span class="input-group-text cursor-pointer"
                                                            id="creditCardMask2"><span class="card-type"></span></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="mb-6">
                                                            <label class="form-label"
                                                                for="collapsible-payment-name">Name</label>
                                                            <input type="text" id="collapsible-payment-name"
                                                                class="form-control" placeholder="John Doe">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="mb-6">
                                                            <label class="form-label"
                                                                for="collapsible-payment-expiry-date">Exp. Date</label>
                                                            <input type="text" id="collapsible-payment-expiry-date"
                                                                class="form-control expiry-date-mask" placeholder="MM/YY">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="mb-6">
                                                            <label class="form-label" for="collapsible-payment-cvv">CVV
                                                                Code</label>
                                                            <div class="input-group input-group-merge">
                                                                <input type="text" id="collapsible-payment-cvv"
                                                                    class="form-control cvv-code-mask" maxlength="3"
                                                                    placeholder="654">
                                                                <span class="input-group-text cursor-pointer"
                                                                    id="collapsible-payment-cvv2"><i
                                                                        class="bx bx-help-circle text-muted"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        aria-label="Card Verification Value"
                                                                        data-bs-original-title="Card Verification Value"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <button type="submit" class="btn btn-primary me-4">Submit</button>
                                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form with Tabs -->
            <div class="row">
                <div class="col">
                    <h6 class="mt-4"> Form with Tabs </h6>
                    <div class="card mb-6">
                        <div class="card-header p-0 nav-align-top">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">Personal
                                        Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-account"
                                        role="tab" aria-selected="false" tabindex="-1">Account Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#form-tabs-social"
                                        role="tab" aria-selected="false" tabindex="-1">Social Links</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="form-tabs-personal" role="tabpanel">
                                <form>
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-first-name">First Name</label>
                                            <input type="text" id="formtabs-first-name" class="form-control"
                                                placeholder="John">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-last-name">Last Name</label>
                                            <input type="text" id="formtabs-last-name" class="form-control"
                                                placeholder="Doe">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-country">Country</label>
                                            <div class="position-relative"><select id="formtabs-country"
                                                    class="select2 form-select select2-hidden-accessible"
                                                    data-allow-clear="true" data-select2-id="formtabs-country"
                                                    tabindex="-1" aria-hidden="true">
                                                    <option value="" data-select2-id="11">Select</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="China">China</option>
                                                    <option value="France">France</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Korea">Korea, Republic of</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Russia">Russian Federation</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="United States">United States</option>
                                                </select><span class="select2 select2-container select2-container--default"
                                                    dir="ltr" data-select2-id="10" style="width: 658px;"><span
                                                        class="selection"><span
                                                            class="select2-selection select2-selection--single"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-formtabs-country-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-formtabs-country-container" role="textbox"
                                                                aria-readonly="true"><span
                                                                    class="select2-selection__placeholder">Select
                                                                    value</span></span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="col-md-6 select2-primary">
                                            <label class="form-label" for="formtabs-language">Language</label>
                                            <div class="position-relative"><select id="formtabs-language"
                                                    class="select2 form-select select2-hidden-accessible" multiple=""
                                                    data-select2-id="formtabs-language" tabindex="-1"
                                                    aria-hidden="true">
                                                    <option value="en" selected="" data-select2-id="13">English
                                                    </option>
                                                    <option value="fr" selected="" data-select2-id="14">French
                                                    </option>
                                                    <option value="de">German</option>
                                                    <option value="pt">Portuguese</option>
                                                </select><span class="select2 select2-container select2-container--default"
                                                    dir="ltr" data-select2-id="12" style="width: 658px;"><span
                                                        class="selection"><span
                                                            class="select2-selection select2-selection--multiple"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="-1" aria-disabled="false">
                                                            <ul class="select2-selection__rendered">
                                                                <li class="select2-selection__choice" title="English"
                                                                    data-select2-id="15"><span
                                                                        class="select2-selection__choice__remove"
                                                                        role="presentation">×</span>English</li>
                                                                <li class="select2-selection__choice" title="French"
                                                                    data-select2-id="16"><span
                                                                        class="select2-selection__choice__remove"
                                                                        role="presentation">×</span>French</li>
                                                                <li class="select2-search select2-search--inline"><input
                                                                        class="select2-search__field" type="search"
                                                                        tabindex="0" autocomplete="off"
                                                                        autocorrect="off" autocapitalize="none"
                                                                        spellcheck="false" role="searchbox"
                                                                        aria-autocomplete="list" placeholder=""
                                                                        style="width: 0.75em;"></li>
                                                            </ul>
                                                        </span></span><span class="dropdown-wrapper"
                                                        aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-birthdate">Birth Date</label>
                                            <input type="text" id="formtabs-birthdate"
                                                class="form-control dob-picker flatpickr-input" placeholder="YYYY-MM-DD"
                                                readonly="readonly">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-phone">Phone No</label>
                                            <input type="text" id="formtabs-phone" class="form-control phone-mask"
                                                placeholder="658 799 8941" aria-label="658 799 8941">
                                        </div>
                                    </div>
                                    <div class="pt-6">
                                        <button type="submit" class="btn btn-primary me-4">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                                <form>
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-username">Username</label>
                                            <input type="text" id="formtabs-username" class="form-control"
                                                placeholder="john.doe">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-email">Email</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="formtabs-email" class="form-control"
                                                    placeholder="john.doe" aria-label="john.doe"
                                                    aria-describedby="formtabs-email2">
                                                <span class="input-group-text" id="formtabs-email2">@example.com</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="formtabs-password">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="formtabs-password" class="form-control"
                                                        placeholder="············" aria-describedby="formtabs-password2">
                                                    <span class="input-group-text cursor-pointer"
                                                        id="formtabs-password2"><i class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="formtabs-confirm-password">Confirm
                                                    Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="formtabs-confirm-password"
                                                        class="form-control" placeholder="············"
                                                        aria-describedby="formtabs-confirm-password2">
                                                    <span class="input-group-text cursor-pointer"
                                                        id="formtabs-confirm-password2"><i class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-6">
                                        <button type="submit" class="btn btn-primary me-4">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="form-tabs-social" role="tabpanel">
                                <form>
                                    <div class="row g-6">
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-twitter">Twitter</label>
                                            <input type="text" id="formtabs-twitter" class="form-control"
                                                placeholder="https://twitter.com/abc">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-facebook">Facebook</label>
                                            <input type="text" id="formtabs-facebook" class="form-control"
                                                placeholder="https://facebook.com/abc">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-google">Google+</label>
                                            <input type="text" id="formtabs-google" class="form-control"
                                                placeholder="https://plus.google.com/abc">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-linkedin">Linkedin</label>
                                            <input type="text" id="formtabs-linkedin" class="form-control"
                                                placeholder="https://linkedin.com/abc">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-instagram">Instagram</label>
                                            <input type="text" id="formtabs-instagram" class="form-control"
                                                placeholder="https://instagram.com/abc">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-quora">Quora</label>
                                            <input type="text" id="formtabs-quora" class="form-control"
                                                placeholder="https://quora.com/abc">
                                        </div>
                                    </div>
                                    <div class="pt-6">
                                        <button type="submit" class="btn btn-primary me-4">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Alignment -->
            <div class="card">
                <h5 class="card-header">Form Alignment</h5>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center h-px-500">
                        <form class="w-px-400 border rounded p-3 p-md-5">
                            <h3 class="mb-6">Sign In</h3>

                            <div class="mb-6">
                                <label class="form-label" for="form-alignment-username">Username</label>
                                <input type="text" id="form-alignment-username" class="form-control"
                                    placeholder="john.doe">
                            </div>

                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="form-alignment-password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="form-alignment-password" class="form-control"
                                        placeholder="············" aria-describedby="form-alignment-password2">
                                    <span class="input-group-text cursor-pointer" id="form-alignment-password2"><i
                                            class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input">
                                    <span class="form-check-label">Remember me</span>
                                </label>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- / Content -->

        <!-- Footer -->
        <!-- Footer-->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
                <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="text-body">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2024, made with ❤️ by <a href="https://themeselection.com" target="_blank"
                            class="footer-link">ThemeSelection</a>
                    </div>
                    <div class="d-none d-lg-inline-block">
                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                        <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/laravel-introduction.html"
                            target="_blank" class="footer-link me-4">Documentation</a>
                        <a href="https://themeselection.com/support/" target="_blank"
                            class="footer-link d-none d-sm-inline-block">Support</a>
                    </div>
                </div>
            </div>
        </footer>
        <!--/ Footer-->
        <!-- / Footer -->
        <div class="content-backdrop fade"></div>
    </div>


    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row mb-6">
                <!-- Browser Default -->
                <div class="col-md mb-6 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Browser Default</h5>
                        <div class="card-body">
                            <form class="browser-default-validation">
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-name">Name</label>
                                    <input type="text" class="form-control" id="basic-default-name"
                                        placeholder="John Doe" required="">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-email">Email</label>
                                    <input type="email" id="basic-default-email" class="form-control"
                                        placeholder="john.doe" required="">
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" for="basic-default-password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="basic-default-password" class="form-control"
                                            placeholder="············" aria-describedby="basic-default-password3"
                                            required="">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password3"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-country">Country</label>
                                    <select class="form-select" id="basic-default-country" required="">
                                        <option value="">Select Country</option>
                                        <option value="usa">USA</option>
                                        <option value="uk">UK</option>
                                        <option value="france">France</option>
                                        <option value="australia">Australia</option>
                                        <option value="spain">Spain</option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-dob">DOB</label>
                                    <input type="text" class="form-control flatpickr-validation flatpickr-input"
                                        id="basic-default-dob" required="">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-upload-file">Profile pic</label>
                                    <input type="file" class="form-control" id="basic-default-upload-file"
                                        required="">
                                </div>
                                <div class="mb-6">
                                    <label class="d-block form-label">Gender</label>
                                    <div class="form-check mb-2">
                                        <input type="radio" id="basic-default-radio-male" name="basic-default-radio"
                                            class="form-check-input" required="" checked="">
                                        <label class="form-check-label" for="basic-default-radio-male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="basic-default-radio-female"
                                            name="basic-default-radio" class="form-check-input" required="">
                                        <label class="form-check-label" for="basic-default-radio-female">Female</label>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-bio">Bio</label>
                                    <textarea class="form-control" id="basic-default-bio" name="basic-default-bio" rows="3" required=""></textarea>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="basic-default-checkbox"
                                            required="">
                                        <label class="form-check-label" for="basic-default-checkbox">Agree to our terms
                                            and conditions</label>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="browserDefaultSwitch"
                                            required="">
                                        <label class="form-check-label" for="browserDefaultSwitch">Send me related
                                            emails</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Browser Default -->

                <!-- Bootstrap Validation -->
                <div class="col-md">
                    <div class="card">
                        <h5 class="card-header">Bootstrap Validation</h5>
                        <div class="card-body">
                            <form class="needs-validation was-validated" novalidate="">
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-name">Name</label>
                                    <input type="text" class="form-control" id="bs-validation-name"
                                        placeholder="John Doe" required="">
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please enter your name. </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-email">Email</label>
                                    <input type="email" id="bs-validation-email" class="form-control"
                                        placeholder="john.doe" aria-label="john.doe" required="">
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please enter a valid email </div>
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" for="bs-validation-password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="bs-validation-password" class="form-control"
                                            placeholder="············" required="">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password4"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please enter your password. </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-country">Country</label>
                                    <select class="form-select" id="bs-validation-country" required="">
                                        <option value="">Select Country</option>
                                        <option value="usa">USA</option>
                                        <option value="uk">UK</option>
                                        <option value="france">France</option>
                                        <option value="australia">Australia</option>
                                        <option value="spain">Spain</option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please select your country </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-dob">DOB</label>
                                    <input type="text" class="form-control flatpickr-validation flatpickr-input"
                                        id="bs-validation-dob" required="">
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please Enter Your DOB </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-upload-file">Profile pic</label>
                                    <input type="file" class="form-control" id="bs-validation-upload-file"
                                        required="">
                                </div>
                                <div class="mb-6">
                                    <label class="d-block form-label">Gender</label>
                                    <div class="form-check mb-2">
                                        <input type="radio" id="bs-validation-radio-male" name="bs-validation-radio"
                                            class="form-check-input" required="" checked="">
                                        <label class="form-check-label" for="bs-validation-radio-male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="bs-validation-radio-female"
                                            name="bs-validation-radio" class="form-check-input" required="">
                                        <label class="form-check-label" for="bs-validation-radio-female">Female</label>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-bio">Bio</label>
                                    <textarea class="form-control" id="bs-validation-bio" name="bs-validation-bio" rows="3" required=""></textarea>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="bs-validation-checkbox"
                                            required="">
                                        <label class="form-check-label" for="bs-validation-checkbox">Agree to our terms
                                            and conditions</label>
                                        <div class="invalid-feedback"> You must agree before submitting. </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="bootstrapValidationSwitch"
                                            required="">
                                        <label class="form-check-label" for="bootstrapValidationSwitch">Send me related
                                            emails</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
            </div>
            <div class="row">
                <!-- FormValidation -->
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">FormValidation</h5>
                        <div class="card-body">

                            <form id="formValidationExamples" class="row g-6 fv-plugins-bootstrap5 fv-plugins-framework"
                                novalidate="novalidate">

                                <!-- Account Details -->

                                <div class="col-12">
                                    <h6>1. Account Details</h6>
                                    <hr class="mt-0">
                                </div>


                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationName">Full Name</label>
                                    <input type="text" id="formValidationName" class="form-control"
                                        placeholder="John Doe" name="formValidationName">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationEmail">Email</label>
                                    <input class="form-control" type="email" id="formValidationEmail"
                                        name="formValidationEmail" placeholder="john.doe">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="formValidationPass">Password</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" id="formValidationPass"
                                                name="formValidationPass" placeholder="············"
                                                aria-describedby="multicol-password2">
                                            <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                                    class="bx bx-hide"></i></span>
                                        </div>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="formValidationConfirmPass">Confirm
                                            Password</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" id="formValidationConfirmPass"
                                                name="formValidationConfirmPass" placeholder="············"
                                                aria-describedby="multicol-confirm-password2">
                                            <span class="input-group-text cursor-pointer"
                                                id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>
                                        </div>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>


                                <!-- Personal Info -->

                                <div class="col-12">
                                    <h6 class="mt-2">2. Personal Info</h6>
                                    <hr class="mt-0">
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label for="formValidationFile" class="form-label">Profile Pic</label>
                                    <input class="form-control" type="file" id="formValidationFile"
                                        name="formValidationFile">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationDob">DOB</label>
                                    <input type="text" class="form-control flatpickr-validation flatpickr-input"
                                        name="formValidationDob" id="formValidationDob" required=""
                                        readonly="readonly">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationSelect2">Country</label>
                                    <div class="position-relative"><select id="formValidationSelect2"
                                            name="formValidationSelect2"
                                            class="form-select select2 select2-hidden-accessible"
                                            data-allow-clear="true" data-select2-id="formValidationSelect2"
                                            tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="2">Select</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Korea">Korea, Republic of</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Russia">Russian Federation</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                        </select><span class="select2 select2-container select2-container--default"
                                            dir="ltr" data-select2-id="1" style="width: 658px;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                    aria-disabled="false"
                                                    aria-labelledby="select2-formValidationSelect2-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-formValidationSelect2-container" role="textbox"
                                                        aria-readonly="true"><span
                                                            class="select2-selection__placeholder">Select
                                                            country</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationLang">Languages</label>
                                    <tags class="tagify form-control tagify--noTags tagify--empty" tabindex="-1">
                                        <span contenteditable="" tabindex="0" data-placeholder="​"
                                            aria-placeholder="" class="tagify__input" role="textbox"
                                            aria-autocomplete="both" aria-multiline="false"></span>
                                        ​
                                    </tags><input type="text" value="" class="form-control"
                                        name="formValidationLang" id="formValidationLang" tabindex="-1">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationTech">Tech</label>
                                    <span class="twitter-typeahead"
                                        style="position: relative; display: inline-block;"><input
                                            class="form-control typeahead tt-hint" type="text" autocomplete="off"
                                            readonly="" spellcheck="false" tabindex="-1"
                                            style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box padding-box rgba(0, 0, 0, 0);"
                                            dir="ltr"><input class="form-control typeahead tt-input"
                                            type="text" id="formValidationTech" name="formValidationTech"
                                            autocomplete="off" spellcheck="false" dir="auto"
                                            style="position: relative; vertical-align: top; background-color: transparent;">
                                        <pre aria-hidden="true"
                                            style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Public Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; font-size: 15px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                                        <div class="tt-menu"
                                            style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                                            <div class="tt-dataset tt-dataset-tech"></div>
                                        </div>
                                    </span>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationHobbies">Hobbies</label>
                                    <div class="dropdown bootstrap-select show-tick hobbies-select w-100"><select
                                            class="selectpicker hobbies-select w-100" id="formValidationHobbies"
                                            data-style="btn-default" data-icon-base="bx"
                                            data-tick-icon="bx-check text-white" name="formValidationHobbies"
                                            multiple="">
                                            <option>Sports</option>
                                            <option>Movies</option>
                                            <option>Books</option>
                                        </select><button type="button" tabindex="-1"
                                            class="btn dropdown-toggle bs-placeholder btn-default"
                                            data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                            aria-haspopup="listbox" aria-expanded="false" title="Nothing selected"
                                            data-id="formValidationHobbies">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">Nothing selected</div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                                aria-multiselectable="true">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationBio">Bio</label>
                                    <textarea class="form-control" id="formValidationBio" name="formValidationBio" rows="3"></textarea>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label">Gender</label>
                                    <div class="form-check custom mb-2">
                                        <input type="radio" id="formValidationGender" name="formValidationGender"
                                            class="form-check-input" checked="">
                                        <label class="form-check-label" for="formValidationGender">Male</label>
                                    </div>

                                    <div class="form-check custom">
                                        <input type="radio" id="formValidationGender2" name="formValidationGender"
                                            class="form-check-input">
                                        <label class="form-check-label" for="formValidationGender2">Female</label>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>


                                <!-- Choose Your Plan -->

                                <div class="col-12">
                                    <h6 class="mt-2">3. Choose Your Plan</h6>
                                    <hr class="mt-0">
                                </div>
                                <div class="row gy-3 mt-0">
                                    <div class="col-xl-3 col-md-5 col-sm-6 col-12 fv-plugins-icon-container">
                                        <div class="form-check custom-option custom-option-icon checked">
                                            <label class="form-check-label custom-option-content" for="basicPlanMain1">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-rocket"></i>
                                                    <span class="custom-option-title"> Starter </span>
                                                    <small> Get 5gb of space and 1 team member. </small>
                                                </span>
                                                <input name="formValidationPlan" class="form-check-input"
                                                    type="radio" value="" id="basicPlanMain1"
                                                    checked="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="basicPlanMain2">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-user"></i>
                                                    <span class="custom-option-title"> Personal </span>
                                                    <small> Get 15gb of space and 5 team member. </small>
                                                </span>
                                                <input name="formValidationPlan" class="form-check-input"
                                                    type="radio" value="" id="basicPlanMain2">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="basicPlanMain3">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-crown"></i>
                                                    <span class="custom-option-title"> Premium </span>
                                                    <small> Get 25gb of space and 15 members. </small>
                                                </span>
                                                <input name="formValidationPlan" class="form-check-input"
                                                    type="radio" value="" id="basicPlanMain3">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>

                                <div class="col-12 fv-plugins-icon-container">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="formValidationSwitch"
                                            name="formValidationSwitch" required="">
                                        <label class="form-check-label" for="formValidationSwitch">Send me related
                                            emails</label>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 fv-plugins-icon-container">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="formValidationCheckbox"
                                            name="formValidationCheckbox">
                                        <label class="form-check-label" for="formValidationCheckbox">Agree to our terms
                                            and conditions</label>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submitButton" class="btn btn-primary">Submit</button>
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /FormValidation -->
            </div>

        </div>
        <!-- / Content -->

        <!-- Footer -->
        <!-- Footer-->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
                <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="text-body">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2024, made with ❤️ by <a href="https://themeselection.com"
                            target="_blank" class="footer-link">ThemeSelection</a>
                    </div>
                    <div class="d-none d-lg-inline-block">
                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                        <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/laravel-introduction.html"
                            target="_blank" class="footer-link me-4">Documentation</a>
                        <a href="https://themeselection.com/support/" target="_blank"
                            class="footer-link d-none d-sm-inline-block">Support</a>
                    </div>
                </div>
            </div>
        </footer>
        <!--/ Footer-->
        <!-- / Footer -->
        <div class="content-backdrop fade"></div>
    </div>

    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row mb-6">
                <!-- Browser Default -->
                <div class="col-md mb-6 mb-md-0">
                    <div class="card">
                        <h5 class="card-header">Browser Default</h5>
                        <div class="card-body">
                            <form class="browser-default-validation">
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-name">Name</label>
                                    <input type="text" class="form-control" id="basic-default-name"
                                        placeholder="John Doe" required="">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-email">Email</label>
                                    <input type="email" id="basic-default-email" class="form-control"
                                        placeholder="john.doe" required="">
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" for="basic-default-password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="basic-default-password" class="form-control"
                                            placeholder="············" aria-describedby="basic-default-password3"
                                            required="">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password3"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-country">Country</label>
                                    <select class="form-select" id="basic-default-country" required="">
                                        <option value="">Select Country</option>
                                        <option value="usa">USA</option>
                                        <option value="uk">UK</option>
                                        <option value="france">France</option>
                                        <option value="australia">Australia</option>
                                        <option value="spain">Spain</option>
                                    </select>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-dob">DOB</label>
                                    <input type="text" class="form-control flatpickr-validation flatpickr-input"
                                        id="basic-default-dob" required="">
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-upload-file">Profile pic</label>
                                    <input type="file" class="form-control" id="basic-default-upload-file"
                                        required="">
                                </div>
                                <div class="mb-6">
                                    <label class="d-block form-label">Gender</label>
                                    <div class="form-check mb-2">
                                        <input type="radio" id="basic-default-radio-male" name="basic-default-radio"
                                            class="form-check-input" required="" checked="">
                                        <label class="form-check-label" for="basic-default-radio-male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="basic-default-radio-female"
                                            name="basic-default-radio" class="form-check-input" required="">
                                        <label class="form-check-label" for="basic-default-radio-female">Female</label>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="basic-default-bio">Bio</label>
                                    <textarea class="form-control" id="basic-default-bio" name="basic-default-bio" rows="3" required=""></textarea>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="basic-default-checkbox"
                                            required="">
                                        <label class="form-check-label" for="basic-default-checkbox">Agree to our terms
                                            and conditions</label>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="browserDefaultSwitch"
                                            required="">
                                        <label class="form-check-label" for="browserDefaultSwitch">Send me related
                                            emails</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Browser Default -->

                <!-- Bootstrap Validation -->
                <div class="col-md">
                    <div class="card">
                        <h5 class="card-header">Bootstrap Validation</h5>
                        <div class="card-body">
                            <form class="needs-validation" novalidate="">
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-name">Name</label>
                                    <input type="text" class="form-control" id="bs-validation-name"
                                        placeholder="John Doe" required="">
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please enter your name. </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-email">Email</label>
                                    <input type="email" id="bs-validation-email" class="form-control"
                                        placeholder="john.doe" aria-label="john.doe" required="">
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please enter a valid email </div>
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" for="bs-validation-password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="bs-validation-password" class="form-control"
                                            placeholder="············" required="">
                                        <span class="input-group-text cursor-pointer" id="basic-default-password4"><i
                                                class="bx bx-hide"></i></span>
                                    </div>
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please enter your password. </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-country">Country</label>
                                    <select class="form-select" id="bs-validation-country" required="">
                                        <option value="">Select Country</option>
                                        <option value="usa">USA</option>
                                        <option value="uk">UK</option>
                                        <option value="france">France</option>
                                        <option value="australia">Australia</option>
                                        <option value="spain">Spain</option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please select your country </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-dob">DOB</label>
                                    <input type="text" class="form-control flatpickr-validation flatpickr-input"
                                        id="bs-validation-dob" required="">
                                    <div class="valid-feedback"> Looks good! </div>
                                    <div class="invalid-feedback"> Please Enter Your DOB </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-upload-file">Profile pic</label>
                                    <input type="file" class="form-control" id="bs-validation-upload-file"
                                        required="">
                                </div>
                                <div class="mb-6">
                                    <label class="d-block form-label">Gender</label>
                                    <div class="form-check mb-2">
                                        <input type="radio" id="bs-validation-radio-male" name="bs-validation-radio"
                                            class="form-check-input" required="" checked="">
                                        <label class="form-check-label" for="bs-validation-radio-male">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="bs-validation-radio-female"
                                            name="bs-validation-radio" class="form-check-input" required="">
                                        <label class="form-check-label" for="bs-validation-radio-female">Female</label>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label class="form-label" for="bs-validation-bio">Bio</label>
                                    <textarea class="form-control" id="bs-validation-bio" name="bs-validation-bio" rows="3" required=""></textarea>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="bs-validation-checkbox"
                                            required="">
                                        <label class="form-check-label" for="bs-validation-checkbox">Agree to our terms
                                            and conditions</label>
                                        <div class="invalid-feedback"> You must agree before submitting. </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="bootstrapValidationSwitch"
                                            required="">
                                        <label class="form-check-label" for="bootstrapValidationSwitch">Send me related
                                            emails</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
            </div>
            <div class="row">
                <!-- FormValidation -->
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">FormValidation</h5>
                        <div class="card-body">

                            <form id="formValidationExamples" class="row g-6 fv-plugins-bootstrap5 fv-plugins-framework"
                                novalidate="novalidate">

                                <!-- Account Details -->

                                <div class="col-12">
                                    <h6>1. Account Details</h6>
                                    <hr class="mt-0">
                                </div>


                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationName">Full Name</label>
                                    <input type="text" id="formValidationName" class="form-control"
                                        placeholder="John Doe" name="formValidationName">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationEmail">Email</label>
                                    <input class="form-control" type="email" id="formValidationEmail"
                                        name="formValidationEmail" placeholder="john.doe">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="formValidationPass">Password</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" id="formValidationPass"
                                                name="formValidationPass" placeholder="············"
                                                aria-describedby="multicol-password2">
                                            <span class="input-group-text cursor-pointer" id="multicol-password2"><i
                                                    class="bx bx-hide"></i></span>
                                        </div>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="formValidationConfirmPass">Confirm
                                            Password</label>
                                        <div class="input-group input-group-merge has-validation">
                                            <input class="form-control" type="password" id="formValidationConfirmPass"
                                                name="formValidationConfirmPass" placeholder="············"
                                                aria-describedby="multicol-confirm-password2">
                                            <span class="input-group-text cursor-pointer"
                                                id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>
                                        </div>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>


                                <!-- Personal Info -->

                                <div class="col-12">
                                    <h6 class="mt-2">2. Personal Info</h6>
                                    <hr class="mt-0">
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label for="formValidationFile" class="form-label">Profile Pic</label>
                                    <input class="form-control" type="file" id="formValidationFile"
                                        name="formValidationFile">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationDob">DOB</label>
                                    <input type="text" class="form-control flatpickr-validation flatpickr-input"
                                        name="formValidationDob" id="formValidationDob" required=""
                                        readonly="readonly">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationSelect2">Country</label>
                                    <div class="position-relative"><select id="formValidationSelect2"
                                            name="formValidationSelect2"
                                            class="form-select select2 select2-hidden-accessible"
                                            data-allow-clear="true" data-select2-id="formValidationSelect2"
                                            tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="2">Select</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Korea">Korea, Republic of</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Russia">Russian Federation</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                        </select><span class="select2 select2-container select2-container--default"
                                            dir="ltr" data-select2-id="1" style="width: 658px;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                    aria-disabled="false"
                                                    aria-labelledby="select2-formValidationSelect2-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-formValidationSelect2-container" role="textbox"
                                                        aria-readonly="true"><span
                                                            class="select2-selection__placeholder">Select
                                                            country</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationLang">Languages</label>
                                    <tags class="tagify form-control tagify--noTags tagify--empty" tabindex="-1">
                                        <span contenteditable="" tabindex="0" data-placeholder="​"
                                            aria-placeholder="" class="tagify__input" role="textbox"
                                            aria-autocomplete="both" aria-multiline="false"></span>
                                        ​
                                    </tags><input type="text" value="" class="form-control"
                                        name="formValidationLang" id="formValidationLang" tabindex="-1">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationTech">Tech</label>
                                    <span class="twitter-typeahead"
                                        style="position: relative; display: inline-block;"><input
                                            class="form-control typeahead tt-hint" type="text" autocomplete="off"
                                            readonly="" spellcheck="false" tabindex="-1"
                                            style="position: absolute; top: 0px; left: 0px; border-color: transparent; box-shadow: none; opacity: 1; background: none 0% 0% / auto repeat scroll padding-box padding-box rgba(0, 0, 0, 0);"
                                            dir="ltr"><input class="form-control typeahead tt-input"
                                            type="text" id="formValidationTech" name="formValidationTech"
                                            autocomplete="off" spellcheck="false" dir="auto"
                                            style="position: relative; vertical-align: top; background-color: transparent;">
                                        <pre aria-hidden="true"
                                            style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Public Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Oxygen, Ubuntu, Cantarell, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; font-size: 15px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: auto; text-transform: none;"></pre>
                                        <div class="tt-menu"
                                            style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;">
                                            <div class="tt-dataset tt-dataset-tech"></div>
                                        </div>
                                    </span>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationHobbies">Hobbies</label>
                                    <div class="dropdown bootstrap-select show-tick hobbies-select w-100"><select
                                            class="selectpicker hobbies-select w-100" id="formValidationHobbies"
                                            data-style="btn-default" data-icon-base="bx"
                                            data-tick-icon="bx-check text-white" name="formValidationHobbies"
                                            multiple="">
                                            <option>Sports</option>
                                            <option>Movies</option>
                                            <option>Books</option>
                                        </select><button type="button" tabindex="-1"
                                            class="btn dropdown-toggle bs-placeholder btn-default"
                                            data-bs-toggle="dropdown" role="combobox" aria-owns="bs-select-1"
                                            aria-haspopup="listbox" aria-expanded="false" title="Nothing selected"
                                            data-id="formValidationHobbies">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">Nothing selected</div>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="dropdown-menu ">
                                            <div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"
                                                aria-multiselectable="true">
                                                <ul class="dropdown-menu inner show" role="presentation"></ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>

                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label" for="formValidationBio">Bio</label>
                                    <textarea class="form-control" id="formValidationBio" name="formValidationBio" rows="3"></textarea>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 fv-plugins-icon-container">
                                    <label class="form-label">Gender</label>
                                    <div class="form-check custom mb-2">
                                        <input type="radio" id="formValidationGender" name="formValidationGender"
                                            class="form-check-input" checked="">
                                        <label class="form-check-label" for="formValidationGender">Male</label>
                                    </div>

                                    <div class="form-check custom">
                                        <input type="radio" id="formValidationGender2" name="formValidationGender"
                                            class="form-check-input">
                                        <label class="form-check-label" for="formValidationGender2">Female</label>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>


                                <!-- Choose Your Plan -->

                                <div class="col-12">
                                    <h6 class="mt-2">3. Choose Your Plan</h6>
                                    <hr class="mt-0">
                                </div>
                                <div class="row gy-3 mt-0">
                                    <div class="col-xl-3 col-md-5 col-sm-6 col-12 fv-plugins-icon-container">
                                        <div class="form-check custom-option custom-option-icon checked">
                                            <label class="form-check-label custom-option-content" for="basicPlanMain1">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-rocket"></i>
                                                    <span class="custom-option-title"> Starter </span>
                                                    <small> Get 5gb of space and 1 team member. </small>
                                                </span>
                                                <input name="formValidationPlan" class="form-check-input"
                                                    type="radio" value="" id="basicPlanMain1"
                                                    checked="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="basicPlanMain2">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-user"></i>
                                                    <span class="custom-option-title"> Personal </span>
                                                    <small> Get 15gb of space and 5 team member. </small>
                                                </span>
                                                <input name="formValidationPlan" class="form-check-input"
                                                    type="radio" value="" id="basicPlanMain2">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content" for="basicPlanMain3">
                                                <span class="custom-option-body">
                                                    <i class="bx bx-crown"></i>
                                                    <span class="custom-option-title"> Premium </span>
                                                    <small> Get 25gb of space and 15 members. </small>
                                                </span>
                                                <input name="formValidationPlan" class="form-check-input"
                                                    type="radio" value="" id="basicPlanMain3">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>

                                <div class="col-12 fv-plugins-icon-container">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="formValidationSwitch"
                                            name="formValidationSwitch" required="">
                                        <label class="form-check-label" for="formValidationSwitch">Send me related
                                            emails</label>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 fv-plugins-icon-container">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="formValidationCheckbox"
                                            name="formValidationCheckbox">
                                        <label class="form-check-label" for="formValidationCheckbox">Agree to our terms
                                            and conditions</label>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="submitButton" class="btn btn-primary">Submit</button>
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /FormValidation -->
            </div>

        </div>
        <!-- / Content -->

        <!-- Footer -->
        <!-- Footer-->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
                <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="text-body">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2024, made with ❤️ by <a href="https://themeselection.com"
                            target="_blank" class="footer-link">ThemeSelection</a>
                    </div>
                    <div class="d-none d-lg-inline-block">
                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                        <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/laravel-introduction.html"
                            target="_blank" class="footer-link me-4">Documentation</a>
                        <a href="https://themeselection.com/support/" target="_blank"
                            class="footer-link d-none d-sm-inline-block">Support</a>
                    </div>
                </div>
            </div>
        </footer>
        <!--/ Footer-->
        <!-- / Footer -->
        <div class="content-backdrop fade"></div>
    </div>
@endsection --}}

{{-- @section('content')
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- DataTable with Buttons -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="card-header flex-column flex-md-row pb-0">
                            <div class="head-label text-center">
                                <h5 class="card-title mb-0">DataTable with Buttons</h5>
                            </div>
                            <div class="dt-action-buttons text-end pt-6 pt-md-0">
                                <div class="dt-buttons btn-group flex-wrap">
                                    <div class="btn-group">
                                        <button class="btn buttons-collection dropdown-toggle btn-label-primary me-4"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                            aria-haspopup="dialog" aria-expanded="false">

                                            <span><i class="bx bx-export bx-sm me-sm-2"></i>
                                                <span class="d-none d-sm-inline-block">Export </span>
                                            </span>
                                        </button>
                                    </div>
                                    <button class="btn btn-secondary create-new btn-primary modal-trigger" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button">

                                        <span><i class="bx bx-plus bx-sm me-sm-2"></i>
                                            <span class="d-none d-sm-inline-block">Add New Record</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select
                                            name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                            class="form-select">
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div
                                class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input
                                            type="search" class="form-control" placeholder=""
                                            aria-controls="DataTables_Table_0"></label></div>
                            </div>
                        </div>
                        <table class="datatables-basic table border-top dataTable no-footer dtr-column"
                            id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                            <thead>
                                <tr>
                                    <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                        style="width: 0px; display: none;" aria-label=""></th>
                                    <th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1"
                                        colspan="1" style="width: 18px;" data-col="1" aria-label=""><input
                                            type="checkbox" class="form-check-input"></th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 316px;"
                                        aria-label="Name: activate to sort column ascending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 300px;"
                                        aria-label="Email: activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 106px;"
                                        aria-label="Date: activate to sort column ascending">Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 104px;"
                                        aria-label="Salary: activate to sort column ascending">Salary</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" style="width: 125px;"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 116px;"
                                        aria-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="  dt-checkboxes-cell"><input type="checkbox"
                                            class="dt-checkboxes form-check-input"></td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><span
                                                        class="avatar-initial rounded-circle bg-label-success">GG</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column"><span class="emp_name text-truncate">Glyn
                                                    Giacoppo</span><small
                                                    class="emp_post text-truncate text-muted">Software Test
                                                    Engineer</small></div>
                                        </div>
                                    </td>
                                    <td>ggiacoppo2r@apache.org</td>
                                    <td>04/15/2021</td>
                                    <td>$24973.48</td>
                                    <td><span class="badge  bg-label-success">Professional</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                    class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0" style="">
                                                <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a></li>
                                            </ul>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-md"></i></a>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="  dt-checkboxes-cell"><input type="checkbox"
                                            class="dt-checkboxes form-check-input"></td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><img
                                                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/10.png"
                                                        alt="Avatar" class="rounded-circle"></div>
                                            </div>
                                            <div class="d-flex flex-column"><span
                                                    class="emp_name text-truncate">Evangelina Carnock</span><small
                                                    class="emp_post text-truncate text-muted">Cost Accountant</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>ecarnock2q@washington.edu</td>
                                    <td>01/26/2021</td>
                                    <td>$23704.82</td>
                                    <td><span class="badge  bg-label-warning">Resigned</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a></li>
                                            </ul>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-md"></i></a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="  dt-checkboxes-cell"><input type="checkbox"
                                            class="dt-checkboxes form-check-input"></td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><img
                                                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/7.png"
                                                        alt="Avatar" class="rounded-circle"></div>
                                            </div>
                                            <div class="d-flex flex-column"><span class="emp_name text-truncate">Olivette
                                                    Gudgin</span><small
                                                    class="emp_post text-truncate text-muted">Paralegal</small></div>
                                        </div>
                                    </td>
                                    <td>ogudgin2p@gizmodo.com</td>
                                    <td>04/09/2021</td>
                                    <td>$15211.60</td>
                                    <td><span class="badge  bg-label-success">Professional</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a></li>
                                            </ul>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-md"></i></a>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="  dt-checkboxes-cell"><input type="checkbox"
                                            class="dt-checkboxes form-check-input"></td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><span
                                                        class="avatar-initial rounded-circle bg-label-danger">RP</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column"><span class="emp_name text-truncate">Reina
                                                    Peckett</span><small class="emp_post text-truncate text-muted">Quality
                                                    Control Specialist</small></div>
                                        </div>
                                    </td>
                                    <td>rpeckett2o@timesonline.co.uk</td>
                                    <td>05/20/2021</td>
                                    <td>$16619.40</td>
                                    <td><span class="badge  bg-label-warning">Resigned</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a></li>
                                            </ul>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-md"></i></a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="  dt-checkboxes-cell"><input type="checkbox"
                                            class="dt-checkboxes form-check-input"></td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><span
                                                        class="avatar-initial rounded-circle bg-label-danger">AB</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column"><span class="emp_name text-truncate">Alaric
                                                    Beslier</span><small class="emp_post text-truncate text-muted">Tax
                                                    Accountant</small></div>
                                        </div>
                                    </td>
                                    <td>abeslier2n@zimbio.com</td>
                                    <td>04/16/2021</td>
                                    <td>$19366.53</td>
                                    <td><span class="badge  bg-label-warning">Resigned</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a></li>
                                            </ul>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-md"></i></a>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="  dt-checkboxes-cell"><input type="checkbox"
                                            class="dt-checkboxes form-check-input"></td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><img
                                                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/avatars/2.png"
                                                        alt="Avatar" class="rounded-circle"></div>
                                            </div>
                                            <div class="d-flex flex-column"><span class="emp_name text-truncate">Edwina
                                                    Ebsworth</span><small class="emp_post text-truncate text-muted">Human
                                                    Resources Assistant</small></div>
                                        </div>
                                    </td>
                                    <td>eebsworth2m@sbwire.com</td>
                                    <td>09/27/2021</td>
                                    <td>$19586.23</td>
                                    <td><span class="badge bg-label-primary">Current</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a></li>
                                            </ul>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-md"></i></a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td class="  dt-checkboxes-cell"><input type="checkbox"
                                            class="dt-checkboxes form-check-input"></td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2"><span
                                                        class="avatar-initial rounded-circle bg-label-danger">RH</span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column"><span class="emp_name text-truncate">Ronica
                                                    Hasted</span><small class="emp_post text-truncate text-muted">Software
                                                    Consultant</small></div>
                                        </div>
                                    </td>
                                    <td>rhasted2l@hexun.com</td>
                                    <td>07/04/2021</td>
                                    <td>$24866.66</td>
                                    <td><span class="badge  bg-label-warning">Resigned</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end m-0">
                                                <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                <div class="dropdown-divider"></div>
                                                <li><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a></li>
                                            </ul>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-md"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                    aria-live="polite">Showing 1 to 7 of 100 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"
                                            id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0"
                                                aria-disabled="true" role="link" data-dt-idx="previous"
                                                tabindex="-1" class="page-link"><i
                                                    class="bx bx-chevron-left bx-18px"></i></a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="DataTables_Table_0" role="link" aria-current="page"
                                                data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_0" role="link" data-dt-idx="1"
                                                tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_0" role="link" data-dt-idx="2"
                                                tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_0" role="link" data-dt-idx="3"
                                                tabindex="0" class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_0" role="link" data-dt-idx="4"
                                                tabindex="0" class="page-link">5</a></li>
                                        <li class="paginate_button page-item disabled" id="DataTables_Table_0_ellipsis">
                                            <a aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                                data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                                        </li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_0" role="link" data-dt-idx="14"
                                                tabindex="0" class="page-link">15</a></li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a
                                                href="#" aria-controls="DataTables_Table_0" role="link"
                                                data-dt-idx="next" tabindex="0" class="page-link"><i
                                                    class="bx bx-chevron-right bx-18px"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div style="width: 1%;"></div>
                    </div>
                </div>
            </div>
            <!-- Modal to add new record -->
            <div class="offcanvas offcanvas-end" id="add-new-record">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body flex-grow-1">
                    <form class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework"
                        id="form-add-new-record" onsubmit="return false" novalidate="novalidate">
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <label class="form-label" for="basicFullname">Full Name</label>
                            <div class="input-group input-group-merge has-validation">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" id="basicFullname" class="form-control dt-full-name"
                                    name="basicFullname" placeholder="John Doe" aria-label="John Doe"
                                    aria-describedby="basicFullname2">
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <label class="form-label" for="basicPost">Post</label>
                            <div class="input-group input-group-merge has-validation">
                                <span id="basicPost2" class="input-group-text"><i class="bx bxs-briefcase"></i></span>
                                <input type="text" id="basicPost" name="basicPost" class="form-control dt-post"
                                    placeholder="Web Developer" aria-label="Web Developer" aria-describedby="basicPost2">
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <label class="form-label" for="basicEmail">Email</label>
                            <div class="input-group input-group-merge has-validation">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="basicEmail" name="basicEmail" class="form-control dt-email"
                                    placeholder="john.doe@example.com" aria-label="john.doe@example.com">
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                            <div class="form-text">
                                You can use letters, numbers &amp; periods
                            </div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <label class="form-label" for="basicDate">Joining Date</label>
                            <div class="input-group input-group-merge has-validation">
                                <span id="basicDate2" class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="text" class="form-control dt-date flatpickr-input" id="basicDate"
                                    name="basicDate" aria-describedby="basicDate2" placeholder="MM/DD/YYYY"
                                    aria-label="MM/DD/YYYY" readonly="readonly">
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="col-sm-12 fv-plugins-icon-container">
                            <label class="form-label" for="basicSalary">Salary</label>
                            <div class="input-group input-group-merge has-validation">
                                <span id="basicSalary2" class="input-group-text"><i class="bx bx-dollar"></i></span>
                                <input type="number" id="basicSalary" name="basicSalary" class="form-control dt-salary"
                                    placeholder="12000" aria-label="12000" aria-describedby="basicSalary2">
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary"
                                data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                        <input type="hidden">
                    </form>

                </div>
            </div>
            <!--/ DataTable with Buttons -->

            <hr class="my-12">

            <!-- Complex Headers -->
            <div class="card">
                <h5 class="card-header pb-0 text-md-start text-center">Complex Headers</h5>
                <div class="card-datatable text-nowrap">
                    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="DataTables_Table_1_length"><label>Show <select
                                            name="DataTables_Table_1_length" aria-controls="DataTables_Table_1"
                                            class="form-select">
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div
                                class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0">
                                <div id="DataTables_Table_1_filter" class="dataTables_filter"><label>Search:<input
                                            type="search" class="form-control" placeholder=""
                                            aria-controls="DataTables_Table_1"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="dt-complex-header table table-bordered dataTable no-footer"
                                id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"
                                style="width: 1392px;">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="sorting sorting_asc" tabindex="0"
                                            aria-controls="DataTables_Table_1" colspan="1"
                                            aria-label="Name: activate to sort column descending" aria-sort="ascending"
                                            style="width: 166px;">Name</th>
                                        <th colspan="2" rowspan="1">Contact</th>
                                        <th colspan="3" rowspan="1">HR Information</th>
                                        <th rowspan="2" class="sorting_disabled" colspan="1" aria-label="Actions"
                                            style="width: 88px;">Actions</th>
                                    </tr>
                                    <tr>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                            rowspan="1" colspan="1"
                                            aria-label="E-mail: activate to sort column ascending" style="width: 235px;">
                                            E-mail</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                            rowspan="1" colspan="1"
                                            aria-label="City: activate to sort column ascending" style="width: 171px;">
                                            City</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                            rowspan="1" colspan="1"
                                            aria-label="Position: activate to sort column ascending"
                                            style="width: 235px;">Position</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                            rowspan="1" colspan="1"
                                            aria-label="Salary: activate to sort column ascending" style="width: 76px;">
                                            Salary</th>
                                        <th class="border-1 sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                            rowspan="1" colspan="1"
                                            aria-label="Status: activate to sort column ascending" style="width: 103px;">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd">
                                        <td class="sorting_1">Aila Quailadis</td>
                                        <td>aquail29@prlog.org</td>
                                        <td>Shuangchahe</td>
                                        <td>Technical Writer</td>
                                        <td>$24137.29</td>
                                        <td><span class="badge  bg-label-warning">Resigned</span></td>
                                        <td>
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                        class="dropdown-item">Details</a><a href="javascript:;"
                                                        class="dropdown-item">Archive</a>
                                                    <div class="dropdown-divider"></div><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a>
                                                </div>
                                            </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Aili De Coursey</td>
                                        <td>adew@etsy.com</td>
                                        <td>Łazy</td>
                                        <td>Environmental Specialist</td>
                                        <td>$14082.44</td>
                                        <td><span class="badge  bg-label-info">Applied</span></td>
                                        <td>
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                        class="dropdown-item">Details</a><a href="javascript:;"
                                                        class="dropdown-item">Archive</a>
                                                    <div class="dropdown-divider"></div><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a>
                                                </div>
                                            </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="sorting_1">Alaric Beslier</td>
                                        <td>abeslier2n@zimbio.com</td>
                                        <td>Ocucaje</td>
                                        <td>Tax Accountant</td>
                                        <td>$19366.53</td>
                                        <td><span class="badge  bg-label-warning">Resigned</span></td>
                                        <td>
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                        class="dropdown-item">Details</a><a href="javascript:;"
                                                        class="dropdown-item">Archive</a>
                                                    <div class="dropdown-divider"></div><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a>
                                                </div>
                                            </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Aliza MacElholm</td>
                                        <td>amacelholm20@printfriendly.com</td>
                                        <td>Sosnovyy Bor</td>
                                        <td>VP Sales</td>
                                        <td>$16741.31</td>
                                        <td><span class="badge  bg-label-success">Professional</span></td>
                                        <td>
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                        class="dropdown-item">Details</a><a href="javascript:;"
                                                        class="dropdown-item">Archive</a>
                                                    <div class="dropdown-divider"></div><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a>
                                                </div>
                                            </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="sorting_1">Allyson Moakler</td>
                                        <td>amoakler8@shareasale.com</td>
                                        <td>Mogilany</td>
                                        <td>Safety Technician</td>
                                        <td>$11677.32</td>
                                        <td><span class="badge  bg-label-info">Applied</span></td>
                                        <td>
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                        class="dropdown-item">Details</a><a href="javascript:;"
                                                        class="dropdown-item">Archive</a>
                                                    <div class="dropdown-divider"></div><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a>
                                                </div>
                                            </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="even">
                                        <td class="sorting_1">Alma Harvatt</td>
                                        <td>aharvatt11@addtoany.com</td>
                                        <td>Ulundi</td>
                                        <td>Administrative Assistant</td>
                                        <td>$21782.82</td>
                                        <td><span class="badge bg-label-primary">Current</span></td>
                                        <td>
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                        class="dropdown-item">Details</a><a href="javascript:;"
                                                        class="dropdown-item">Archive</a>
                                                    <div class="dropdown-divider"></div><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a>
                                                </div>
                                            </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="odd">
                                        <td class="sorting_1">Annetta Glozman</td>
                                        <td>aglozman1r@storify.com</td>
                                        <td>Pendawanbaru</td>
                                        <td>Staff Accountant</td>
                                        <td>$10745.32</td>
                                        <td><span class="badge  bg-label-info">Applied</span></td>
                                        <td>
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                        class="dropdown-item">Details</a><a href="javascript:;"
                                                        class="dropdown-item">Archive</a>
                                                    <div class="dropdown-divider"></div><a href="javascript:;"
                                                        class="dropdown-item text-danger delete-record">Delete</a>
                                                </div>
                                            </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_info" id="DataTables_Table_1_info" role="status"
                                    aria-live="polite">Showing 1 to 7 of 100 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"
                                            id="DataTables_Table_1_previous"><a aria-controls="DataTables_Table_1"
                                                aria-disabled="true" role="link" data-dt-idx="previous"
                                                tabindex="-1" class="page-link"><i
                                                    class="bx bx-chevron-left bx-18px"></i></a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="DataTables_Table_1" role="link" aria-current="page"
                                                data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_1" role="link" data-dt-idx="1"
                                                tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_1" role="link" data-dt-idx="2"
                                                tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_1" role="link" data-dt-idx="3"
                                                tabindex="0" class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_1" role="link" data-dt-idx="4"
                                                tabindex="0" class="page-link">5</a></li>
                                        <li class="paginate_button page-item disabled" id="DataTables_Table_1_ellipsis">
                                            <a aria-controls="DataTables_Table_1" aria-disabled="true" role="link"
                                                data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                                        </li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_1" role="link" data-dt-idx="14"
                                                tabindex="0" class="page-link">15</a></li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_1_next"><a
                                                href="#" aria-controls="DataTables_Table_1" role="link"
                                                data-dt-idx="next" tabindex="0" class="page-link"><i
                                                    class="bx bx-chevron-right bx-18px"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Complex Headers -->

            <hr class="my-12">

            <!-- Row grouping -->
            <div class="card">
                <h5 class="card-header pb-0 text-md-start text-center">Row Grouping</h5>
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_2_wrapper" class="dataTables_wrapper dt-bootstrap5">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="DataTables_Table_2_length"><label>Show <select
                                            name="DataTables_Table_2_length" aria-controls="DataTables_Table_2"
                                            class="form-select">
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select> entries</label></div>
                            </div>
                            <div
                                class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0">
                                <div id="DataTables_Table_2_filter" class="dataTables_filter"><label>Search:<input
                                            type="search" class="form-control" placeholder=""
                                            aria-controls="DataTables_Table_2"></label></div>
                            </div>
                        </div>
                        <table class="dt-row-grouping table border-top dataTable dtr-column" id="DataTables_Table_2"
                            aria-describedby="DataTables_Table_2_info" style="width: 1392px;">
                            <thead>
                                <tr>
                                    <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                        style="width: 0px; display: none;" aria-label=""></th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1"
                                        colspan="1" style="width: 188px;"
                                        aria-label="Name: activate to sort column ascending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1"
                                        colspan="1" style="width: 278px;"
                                        aria-label="Email: activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1"
                                        colspan="1" style="width: 202px;"
                                        aria-label="City: activate to sort column ascending">City</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1"
                                        colspan="1" style="width: 97px;"
                                        aria-label="Date: activate to sort column ascending">Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1"
                                        colspan="1" style="width: 95px;"
                                        aria-label="Salary: activate to sort column ascending">Salary</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_2" rowspan="1"
                                        colspan="1" style="width: 114px;"
                                        aria-label="Status: activate to sort column ascending">Status</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 106px;"
                                        aria-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="group">
                                    <td colspan="8">Accountant</td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Carmita Medling</td>
                                    <td>cmedlingo@hp.com</td>
                                    <td>Bourges</td>
                                    <td>07/31/2021</td>
                                    <td>$13602.24</td>
                                    <td><span class="badge  bg-label-danger">Rejected</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="group">
                                    <td colspan="8">Actuary</td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Latashia Lewtey</td>
                                    <td>llewteyj@sun.com</td>
                                    <td>Hougong</td>
                                    <td>08/03/2021</td>
                                    <td>$18303.87</td>
                                    <td><span class="badge bg-label-primary">Current</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="group">
                                    <td colspan="8">Administrative Assistant</td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Wilmar Bourton</td>
                                    <td>wbourtone@sakura.ne.jp</td>
                                    <td>Bích Động</td>
                                    <td>04/25/2021</td>
                                    <td>$13304.45</td>
                                    <td><span class="badge  bg-label-info">Applied</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Roxie Huck</td>
                                    <td>rhucki@ed.gov</td>
                                    <td>Polýkastro</td>
                                    <td>04/04/2021</td>
                                    <td>$19653.56</td>
                                    <td><span class="badge  bg-label-warning">Resigned</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Alma Harvatt</td>
                                    <td>aharvatt11@addtoany.com</td>
                                    <td>Ulundi</td>
                                    <td>11/04/2021</td>
                                    <td>$21782.82</td>
                                    <td><span class="badge bg-label-primary">Current</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="group">
                                    <td colspan="8">Analog Circuit Design manager</td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Faun Josefsen</td>
                                    <td>fjosefsenl@samsung.com</td>
                                    <td>Wengyang</td>
                                    <td>07/08/2021</td>
                                    <td>$11209.16</td>
                                    <td><span class="badge  bg-label-danger">Rejected</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="group">
                                    <td colspan="8">Analyst Programmer</td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Charlton Chatres</td>
                                    <td>cchatresx@goo.gl</td>
                                    <td>Reguengos de Monsaraz</td>
                                    <td>04/07/2021</td>
                                    <td>$21386.52</td>
                                    <td><span class="badge  bg-label-danger">Rejected</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="control dtr-hidden" rowspan="1" colspan="1"
                                        style="display: none;"></th>
                                    <th rowspan="1" colspan="1">Name</th>
                                    <th rowspan="1" colspan="1">Email</th>
                                    <th rowspan="1" colspan="1">City</th>
                                    <th rowspan="1" colspan="1">Date</th>
                                    <th rowspan="1" colspan="1">Salary</th>
                                    <th rowspan="1" colspan="1">Status</th>
                                    <th rowspan="1" colspan="1">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_info" id="DataTables_Table_2_info" role="status"
                                    aria-live="polite">Showing 1 to 7 of 100 entries</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_2_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"
                                            id="DataTables_Table_2_previous"><a aria-controls="DataTables_Table_2"
                                                aria-disabled="true" role="link" data-dt-idx="previous"
                                                tabindex="-1" class="page-link"><i
                                                    class="bx bx-chevron-left bx-18px"></i></a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="DataTables_Table_2" role="link" aria-current="page"
                                                data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_2" role="link" data-dt-idx="1"
                                                tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_2" role="link" data-dt-idx="2"
                                                tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_2" role="link" data-dt-idx="3"
                                                tabindex="0" class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_2" role="link" data-dt-idx="4"
                                                tabindex="0" class="page-link">5</a></li>
                                        <li class="paginate_button page-item disabled" id="DataTables_Table_2_ellipsis">
                                            <a aria-controls="DataTables_Table_2" aria-disabled="true" role="link"
                                                data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                                        </li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_2" role="link" data-dt-idx="14"
                                                tabindex="0" class="page-link">15</a></li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_2_next"><a
                                                href="#" aria-controls="DataTables_Table_2" role="link"
                                                data-dt-idx="next" tabindex="0" class="page-link"><i
                                                    class="bx bx-chevron-right bx-18px"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Row grouping -->

            <hr class="my-12">

            <!-- Multilingual -->
            <div class="card">
                <h5 class="card-header pb-0 text-md-start text-center">Multilingual</h5>
                <div class="card-datatable table-responsive">
                    <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 ps-md-4">
                                <div class="dataTables_length" id="DataTables_Table_3_length"><label><select
                                            name="DataTables_Table_3_length" aria-controls="DataTables_Table_3"
                                            class="form-select">
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select> Einträge anzeigen</label></div>
                            </div>
                            <div
                                class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0">
                                <div id="DataTables_Table_3_filter" class="dataTables_filter"><label>Suchen<input
                                            type="search" class="form-control" placeholder=""
                                            aria-controls="DataTables_Table_3"></label></div>
                            </div>
                        </div>
                        <table class="dt-multilingual table border-top dataTable no-footer dtr-column"
                            id="DataTables_Table_3" aria-describedby="DataTables_Table_3_info" style="width: 1392px;">
                            <thead>
                                <tr>
                                    <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                        style="width: 0px; display: none;" aria-label=""></th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3"
                                        rowspan="1" colspan="1" style="width: 176px;"
                                        aria-label="Name: aktivieren, um Spalte aufsteigend zu sortieren">Name</th>
                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_3"
                                        rowspan="1" colspan="1" style="width: 259px;"
                                        aria-label="Position: aktivieren, um Spalte aufsteigend zu sortieren"
                                        aria-sort="descending">Position</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3"
                                        rowspan="1" colspan="1" style="width: 262px;"
                                        aria-label="Email: aktivieren, um Spalte aufsteigend zu sortieren">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3"
                                        rowspan="1" colspan="1" style="width: 89px;"
                                        aria-label="Date: aktivieren, um Spalte aufsteigend zu sortieren">Date</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3"
                                        rowspan="1" colspan="1" style="width: 88px;"
                                        aria-label="Salary: aktivieren, um Spalte aufsteigend zu sortieren">Salary</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_3"
                                        rowspan="1" colspan="1" style="width: 107px;"
                                        aria-label="Status: aktivieren, um Spalte aufsteigend zu sortieren">Status</th>
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 99px;"
                                        aria-label="Actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Titus Hayne</td>
                                    <td class="sorting_1">Web Designer</td>
                                    <td>thayneh@kickstarter.com</td>
                                    <td>05/25/2021</td>
                                    <td>$16871.48</td>
                                    <td><span class="badge bg-label-primary">Current</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Pegeen Peasegod</td>
                                    <td class="sorting_1">Web Designer</td>
                                    <td>ppeasegod22@slideshare.net</td>
                                    <td>05/21/2021</td>
                                    <td>$24014.04</td>
                                    <td><span class="badge  bg-label-danger">Rejected</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Tammie Wattins</td>
                                    <td class="sorting_1">Web Designer</td>
                                    <td>twattins28@statcounter.com</td>
                                    <td>08/07/2021</td>
                                    <td>$16049.93</td>
                                    <td><span class="badge  bg-label-success">Professional</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Silvain Siebert</td>
                                    <td class="sorting_1">VP Sales</td>
                                    <td>ssiebert1u@domainmarket.com</td>
                                    <td>09/23/2021</td>
                                    <td>$23347.17</td>
                                    <td><span class="badge  bg-label-info">Applied</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Aliza MacElholm</td>
                                    <td class="sorting_1">VP Sales</td>
                                    <td>amacelholm20@printfriendly.com</td>
                                    <td>11/17/2021</td>
                                    <td>$16741.31</td>
                                    <td><span class="badge  bg-label-success">Professional</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Bailie Coulman</td>
                                    <td class="sorting_1">VP Quality Control</td>
                                    <td>bcoulman1@yolasite.com</td>
                                    <td>05/20/2021</td>
                                    <td>$13633.69</td>
                                    <td><span class="badge  bg-label-success">Professional</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                                <tr class="odd">
                                    <td class="  control" tabindex="0" style="display: none;"></td>
                                    <td>Beatrix Longland</td>
                                    <td class="sorting_1">VP Quality Control</td>
                                    <td>blongland12@gizmodo.com</td>
                                    <td>07/18/2021</td>
                                    <td>$22794.60</td>
                                    <td><span class="badge  bg-label-success">Professional</span></td>
                                    <td>
                                        <div class="d-inline-block"><a href="javascript:;"
                                                class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded bx-sm"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"
                                                    class="dropdown-item">Details</a><a href="javascript:;"
                                                    class="dropdown-item">Archive</a>
                                                <div class="dropdown-divider"></div><a href="javascript:;"
                                                    class="dropdown-item text-danger delete-record">Delete</a>
                                            </div>
                                        </div><a href="javascript:;" class="btn btn-icon item-edit"><i
                                                class="bx bx-edit bx-sm"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_info" id="DataTables_Table_3_info" role="status"
                                    aria-live="polite">1 bis 7 von 100 Einträgen</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_3_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled"
                                            id="DataTables_Table_3_previous"><a aria-controls="DataTables_Table_3"
                                                aria-disabled="true" role="link" data-dt-idx="previous"
                                                tabindex="-1" class="page-link"><i
                                                    class="bx bx-chevron-left bx-18px"></i></a></li>
                                        <li class="paginate_button page-item active"><a href="#"
                                                aria-controls="DataTables_Table_3" role="link" aria-current="page"
                                                data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_3" role="link" data-dt-idx="1"
                                                tabindex="0" class="page-link">2</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_3" role="link" data-dt-idx="2"
                                                tabindex="0" class="page-link">3</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_3" role="link" data-dt-idx="3"
                                                tabindex="0" class="page-link">4</a></li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_3" role="link" data-dt-idx="4"
                                                tabindex="0" class="page-link">5</a></li>
                                        <li class="paginate_button page-item disabled" id="DataTables_Table_3_ellipsis">
                                            <a aria-controls="DataTables_Table_3" aria-disabled="true" role="link"
                                                data-dt-idx="ellipsis" tabindex="-1" class="page-link">…</a>
                                        </li>
                                        <li class="paginate_button page-item "><a href="#"
                                                aria-controls="DataTables_Table_3" role="link" data-dt-idx="14"
                                                tabindex="0" class="page-link">15</a></li>
                                        <li class="paginate_button page-item next" id="DataTables_Table_3_next"><a
                                                href="#" aria-controls="DataTables_Table_3" role="link"
                                                data-dt-idx="next" tabindex="0" class="page-link"><i
                                                    class="bx bx-chevron-right bx-18px"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Multilingual -->

        </div>
        <!-- / Content -->

        <!-- Footer -->
        <!-- Footer-->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
                <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                    <div class="text-body">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2024, made with ❤️ by <a href="https://themeselection.com"
                            target="_blank" class="footer-link">ThemeSelection</a>
                    </div>
                    <div class="d-none d-lg-inline-block">
                        <a href="https://themeselection.com/license/" class="footer-link me-4"
                            target="_blank">License</a>
                        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>
                        <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/laravel-introduction.html"
                            target="_blank" class="footer-link me-4">Documentation</a>
                        <a href="https://themeselection.com/support/" target="_blank"
                            class="footer-link d-none d-sm-inline-block">Support</a>
                    </div>
                </div>
            </div>
        </footer>
        <!--/ Footer-->
        <!-- / Footer -->
        <div class="content-backdrop fade"></div>
    </div>
@endsection --}}

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
            novalidate="novalidate">
            <input type="hidden" name="id" id="user_id" value="">
            <div class="mb-6 fv-plugins-icon-container">
                <label class="form-label" for="add-user-fullname">Full Name</label>
                <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="name"
                    aria-label="John Doe" value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="mb-6 fv-plugins-icon-container">
                <label class="form-label" for="add-user-email">Email</label>
                <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com"
                    aria-label="john.doe@example.com" name="email" value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="mb-6 fv-plugins-icon-container">
                <label class="form-label" for="add-user-contact">Contact</label>
                <input type="text" id="add-user-contact" class="form-control phone-mask"
                    placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact"
                    value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="mb-6 fv-plugins-icon-container">
                <label class="form-label" for="add-user-company">Company</label>
                <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer"
                    aria-label="jdoe1" name="company" value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div class="mb-6">
                <label class="form-label" for="country">Country</label>
                <div class="position-relative"><select id="country"
                        class="select2 form-select select2-hidden-accessible" data-select2-id="country" tabindex="-1"
                        aria-hidden="true">
                        <option value="" data-select2-id="2">Select</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Canada">Canada</option>
                        <option value="China">China</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                    </select><span class="select2 select2-container select2-container--default" dir="ltr"
                        data-select2-id="1" style="width: 352px;"><span class="selection"><span
                                class="select2-selection select2-selection--single" role="combobox"
                                aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                aria-labelledby="select2-country-container"><span class="select2-selection__rendered"
                                    id="select2-country-container" role="textbox" aria-readonly="true"><span
                                        class="select2-selection__placeholder">Select Country</span></span><span
                                    class="select2-selection__arrow" role="presentation"><b
                                        role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                            aria-hidden="true"></span></span></div>
            </div>
            <div class="mb-6">
                <label class="form-label" for="user-role">User Role</label>
                <select id="user-role" class="form-select">
                    <option value="subscriber">Subscriber</option>
                    <option value="editor">Editor</option>
                    <option value="maintainer">Maintainer</option>
                    <option value="author">Author</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="form-label" for="user-plan">Select Plan</label>
                <select id="user-plan" class="form-select">
                    <option value="basic">Basic</option>
                    <option value="enterprise">Enterprise</option>
                    <option value="company">Company</option>
                    <option value="team">Team</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
            <input type="hidden">
        </form>
    </div>
</div>

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">5</h4>
                                    <p class="text-success mb-0">(100%)</p>
                                </div>
                                <small class="mb-0">Total Users</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-user bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Verified Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">0</h4>
                                    <p class="text-success mb-0">(+95%)</p>
                                </div>
                                <small class="mb-0">Recent analytics </small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-user-check bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Duplicate Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">0</h4>
                                    <p class="text-success mb-0">(0%)</p>
                                </div>
                                <small class="mb-0">Recent analytics</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="bx bx-group bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Verification Pending</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">5</h4>
                                    <p class="text-danger mb-0">(+6%)</p>
                                </div>
                                <small class="mb-0">Recent analytics</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="bx bx-user-voice bx-lg"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Search Filter</h5>
            </div>
            <div class="card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="ms-n2">
                                <div class="dataTables_length" id="DataTables_Table_0_length"><label><select
                                            name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                            class="form-select">
                                            <option value="7">7</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="70">70</option>
                                            <option value="100">100</option>
                                        </select></label></div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div
                                class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0">
                                <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input
                                            type="search" class="form-control" placeholder="Search User"
                                            aria-controls="DataTables_Table_0"></label></div>
                                <div class="dt-buttons btn-group flex-wrap">
                                    <div class="btn-group"><button
                                            class="btn buttons-collection dropdown-toggle btn-label-secondary mx-4"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                            aria-haspopup="dialog" aria-expanded="false"><span><i
                                                    class="bx bx-export me-2 bx-sm"></i>Export</span></button></div>
                                    <button class="btn btn-secondary add-new btn-primary" tabindex="0"
                                        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasAddUser"><span><i
                                                class="bx bx-plus bx-sm me-0 me-sm-2"></i><span
                                                class="d-none d-sm-inline-block">Abrir modal</span></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="datatables-users table border-top dataTable no-footer dtr-column"
                        id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
                        <thead>
                            <tr>
                                <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                    style="width: 0px; display: none;" aria-label=""></th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 61px;"
                                    aria-label="Id">Id</th>
                                <th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" style="width: 288px;" aria-sort="descending"
                                    aria-label="User: activate to sort column ascending">User</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 457px;"
                                    aria-label="Email: activate to sort column ascending">Email</th>
                                <th class="text-center sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                    rowspan="1" colspan="1" style="width: 154px;"
                                    aria-label="Verified: activate to sort column ascending">Verified</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 217px;"
                                    aria-label="Actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd">
                                <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                <td><span>1</span></td>
                                <td class="sorting_1">
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-4"><span
                                                    class="avatar-initial rounded-circle bg-label-danger">JD</span></div>
                                        </div>
                                        <div class="d-flex flex-column"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="text-truncate text-heading"><span class="fw-medium">John
                                                    Doe</span></a></div>
                                    </div>
                                </td>
                                <td class="" style=""><span class="user-email">johndoe@user.com</span></td>
                                <td class="text-center" style=""><i class="bx fs-4 bx-shield-x text-danger"></i>
                                </td>
                                <td class="" style="">
                                    <div class="d-flex align-items-center gap-50"><button
                                            class="btn btn-sm btn-icon edit-record" data-id="215"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i
                                                class="bx bx-edit"></i></button><button
                                            class="btn btn-sm btn-icon delete-record" data-id="215"><i
                                                class="bx bx-trash"></i></button><button
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="dropdown-item">View</a><a href="javascript:;"
                                                class="dropdown-item">Suspend</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                <td><span>2</span></td>
                                <td class="sorting_1">
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-4"><span
                                                    class="avatar-initial rounded-circle bg-label-success">G</span></div>
                                        </div>
                                        <div class="d-flex flex-column"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="text-truncate text-heading"><span
                                                    class="fw-medium">Guest</span></a></div>
                                    </div>
                                </td>
                                <td class="" style=""><span class="user-email">guest@guest.com</span></td>
                                <td class="text-center" style=""><i class="bx fs-4 bx-shield-x text-danger"></i>
                                </td>
                                <td class="" style="">
                                    <div class="d-flex align-items-center gap-50"><button
                                            class="btn btn-sm btn-icon edit-record" data-id="214"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i
                                                class="bx bx-edit"></i></button><button
                                            class="btn btn-sm btn-icon delete-record" data-id="214"><i
                                                class="bx bx-trash"></i></button><button
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="dropdown-item">View</a><a href="javascript:;"
                                                class="dropdown-item">Suspend</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                <td><span>3</span></td>
                                <td class="sorting_1">
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-4"><span
                                                    class="avatar-initial rounded-circle bg-label-success">AS</span></div>
                                        </div>
                                        <div class="d-flex flex-column"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="text-truncate text-heading"><span class="fw-medium">Ajay
                                                    Sharma</span></a></div>
                                    </div>
                                </td>
                                <td class="" style=""><span
                                        class="user-email">panditajaysharma09@gmail.com</span></td>
                                <td class="text-center" style=""><i class="bx fs-4 bx-shield-x text-danger"></i>
                                </td>
                                <td class="" style="">
                                    <div class="d-flex align-items-center gap-50"><button
                                            class="btn btn-sm btn-icon edit-record" data-id="210"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i
                                                class="bx bx-edit"></i></button><button
                                            class="btn btn-sm btn-icon delete-record" data-id="210"><i
                                                class="bx bx-trash"></i></button><button
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="dropdown-item">View</a><a href="javascript:;"
                                                class="dropdown-item">Suspend</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="even">
                                <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                <td><span>4</span></td>
                                <td class="sorting_1">
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-4"><span
                                                    class="avatar-initial rounded-circle bg-label-warning">A</span></div>
                                        </div>
                                        <div class="d-flex flex-column"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="text-truncate text-heading"><span
                                                    class="fw-medium">Admin</span></a></div>
                                    </div>
                                </td>
                                <td class="" style=""><span class="user-email">admin@admin.com</span></td>
                                <td class="text-center" style=""><i class="bx fs-4 bx-shield-x text-danger"></i>
                                </td>
                                <td class="" style="">
                                    <div class="d-flex align-items-center gap-50"><button
                                            class="btn btn-sm btn-icon edit-record" data-id="201"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i
                                                class="bx bx-edit"></i></button><button
                                            class="btn btn-sm btn-icon delete-record" data-id="201"><i
                                                class="bx bx-trash"></i></button><button
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="dropdown-item">View</a><a href="javascript:;"
                                                class="dropdown-item">Suspend</a></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="odd">
                                <td class="control dtr-hidden" tabindex="0" style="display: none;"></td>
                                <td><span>5</span></td>
                                <td class="sorting_1">
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-4"><span
                                                    class="avatar-initial rounded-circle bg-label-danger">5</span></div>
                                        </div>
                                        <div class="d-flex flex-column"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="text-truncate text-heading"><span
                                                    class="fw-medium">56cf456h4599</span></a></div>
                                    </div>
                                </td>
                                <td class="" style=""><span class="user-email">emp1@tridentmeds.com</span>
                                </td>
                                <td class="text-center" style=""><i class="bx fs-4 bx-shield-x text-danger"></i>
                                </td>
                                <td class="" style="">
                                    <div class="d-flex align-items-center gap-50"><button
                                            class="btn btn-sm btn-icon edit-record" data-id="200"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><i
                                                class="bx bx-edit"></i></button><button
                                            class="btn btn-sm btn-icon delete-record" data-id="200"><i
                                                class="bx bx-trash"></i></button><button
                                            class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu dropdown-menu-end m-0"><a
                                                href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1/app/user/view/account"
                                                class="dropdown-item">View</a><a href="javascript:;"
                                                class="dropdown-item">Suspend</a></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                Displaying 1 to 5 of 5 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled"
                                        id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0"
                                            aria-disabled="true" role="link" data-dt-idx="previous" tabindex="-1"
                                            class="page-link"><i class="bx bx-chevron-left bx-sm"></i></a></li>
                                    <li class="paginate_button page-item active"><a href="#"
                                            aria-controls="DataTables_Table_0" role="link" aria-current="page"
                                            data-dt-idx="0" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a
                                            aria-controls="DataTables_Table_0" aria-disabled="true" role="link"
                                            data-dt-idx="next" tabindex="-1" class="page-link"><i
                                                class="bx bx-chevron-right bx-sm"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Offcanvas to add new user -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                    <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
                        novalidate="novalidate">
                        <input type="hidden" name="id" id="user_id" value="">
                        <div class="mb-6 fv-plugins-icon-container">
                            <label class="form-label" for="add-user-fullname">Full Name</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                                name="name" aria-label="John Doe" value="">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-6 fv-plugins-icon-container">
                            <label class="form-label" for="add-user-email">Email</label>
                            <input type="text" id="add-user-email" class="form-control"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email"
                                value="">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-6 fv-plugins-icon-container">
                            <label class="form-label" for="add-user-contact">Contact</label>
                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact"
                                value="">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-6 fv-plugins-icon-container">
                            <label class="form-label" for="add-user-company">Company</label>
                            <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer"
                                aria-label="jdoe1" name="company" value="">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="country">Country</label>
                            <div class="position-relative"><select id="country"
                                    class="select2 form-select select2-hidden-accessible" data-select2-id="country"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="2">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select><span class="select2 select2-container select2-container--default" dir="ltr"
                                    data-select2-id="1" style="width: 352px;"><span class="selection"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false" aria-labelledby="select2-country-container"><span
                                                class="select2-selection__rendered" id="select2-country-container"
                                                role="textbox" aria-readonly="true"><span
                                                    class="select2-selection__placeholder">Select
                                                    Country</span></span><span class="select2-selection__arrow"
                                                role="presentation"><b role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="user-role">User Role</label>
                            <select id="user-role" class="form-select">
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="maintainer">Maintainer</option>
                                <option value="author">Author</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="user-plan">Select Plan</label>
                            <select id="user-plan" class="form-select">
                                <option value="basic">Basic</option>
                                <option value="enterprise">Enterprise</option>
                                <option value="company">Company</option>
                                <option value="team">Team</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
                        <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
                        <input type="hidden">
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
