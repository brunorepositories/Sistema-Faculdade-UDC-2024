@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">


            <div class="col-md">
                <div class="card">
                    <h5 class="card-header">Cadastrar novo produto</h5>
                    <div class="card-body">
                        <form class="needs-validation was-validated" action="{{ route('product.store') }}" novalidate=""
                            method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="bs-validation-name">Nome do produto</label>
                                <input name="nome" type="text" class="form-control" id="bs-validation-name"
                                    placeholder="Informe o nome" required="">
                                {{-- <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please enter your name. </div> --}}
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="bs-validation-name">Preço</label>
                                <input name="preco" type="number" class="form-control" id="bs-validation-name"
                                    placeholder="Informe o nome" required="">
                                {{-- <div class="valid-feedback"> Looks good! </div>
                              <div class="invalid-feedback"> Please enter your name. </div> --}}
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>



                            {{--
                            <div class="mb-6">
                                <label class="form-label" for="bs-validation-email">Email</label>
                                <input type="email" id="bs-validation-email" class="form-control" placeholder="john.doe"
                                    aria-label="john.doe" required="">
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
                                <input type="file" class="form-control" id="bs-validation-upload-file" required="">
                            </div>
                            <div class="mb-6">
                                <label class="d-block form-label">Gender</label>
                                <div class="form-check mb-2">
                                    <input type="radio" id="bs-validation-radio-male" name="bs-validation-radio"
                                        class="form-check-input" required="" checked="">
                                    <label class="form-check-label" for="bs-validation-radio-male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="bs-validation-radio-female" name="bs-validation-radio"
                                        class="form-check-input" required="">
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
                            </div> --}}

                        </form>
                    </div>
                </div>
            </div>


        </div>

    @endsection
