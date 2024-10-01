@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
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
@endsection
