@extends('Admin.layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Web Setting</h3>
            <ul class="breadcrumbs mb-3">
                <!-- <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li> -->
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Elements</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.web_config.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Web Title and Tagline -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="web_title">Web Title</label>
                                        <input type="text" name="web_title" class="form-control" id="web_title" value="{{ $config->web_title ?? '' }}" placeholder="Enter Web Title">
                                        <small class="form-text text-muted">Web Title Name</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">Tagline</label>
                                        <input type="text" name="tagline" class="form-control" id="tagline" value="{{ $config->tagline ?? '' }}" placeholder="Enter Tagline">
                                        <small class="form-text text-muted">Website Tagline</small>
                                    </div>
                                </div>

                                <!-- Email Addresses -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="primary_email">Primary Email</label>
                                        <input type="email" name="primary_email" class="form-control" id="primary_email" value="{{ $config->primary_email ?? '' }}" placeholder="Enter Primary Email">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="support_email">Support Email</label>
                                        <input type="email" name="support_email" class="form-control" id="support_email" value="{{ $config->support_email ?? '' }}" placeholder="Enter Support Email">
                                    </div>
                                </div>

                                <!-- Phone Numbers -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="primary_phone">Primary Phone</label>
                                        <input type="text" name="primary_phone" class="form-control" id="primary_phone" value="{{ $config->primary_phone ?? '' }}" placeholder="Enter Primary Phone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="secondary_phone">Secondary Phone</label>
                                        <input type="text" name="secondary_phone" class="form-control" id="secondary_phone" value="{{ $config->secondary_phone ?? '' }}" placeholder="Enter Secondary Phone">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter Address">{{ $config->address ?? '' }}</textarea>
                                    </div>
                                </div>

                                <!-- Colors -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="color_primary">Primary Color</label>
                                        <input type="text" name="color_primary" class="form-control" id="color_primary" value="{{ $config->color_primary ?? '' }}" placeholder="Enter Primary Color">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="color_secondary">Secondary Color</label>
                                        <input type="text" name="color_secondary" class="form-control" id="color_secondary" value="{{ $config->color_secondary ?? '' }}" placeholder="Enter Secondary Color">
                                    </div>
                                </div>

                                <!-- Logo and Favicon -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <input type="file" name="logo" class="form-control" id="logo">
                                        @if($config->logo)
                                        <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="fav_icon">Favicon</label>
                                        <input type="file" name="fav_icon" class="form-control" id="fav_icon">
                                        @if($config->fav_icon)
                                            <img src="{{ asset('storage/' . $config->fav_icon) }}" alt="Favicon" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                                    </div>
                                </div>

                                <!-- Social Media Links -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="facebook_link">Facebook Link</label>
                                        <input type="url" name="facebook_link" class="form-control" id="facebook_link" value="{{ $config->facebook_link ?? '' }}" placeholder="Enter Facebook URL">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="twitter_link">Twitter Link</label>
                                        <input type="url" name="twitter_link" class="form-control" id="twitter_link" value="{{ $config->twitter_link ?? '' }}" placeholder="Enter Twitter URL">
                                    </div>
                                </div>

                                <!-- Terms and Privacy -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="privacy_policy">Privacy Policy</label>
                                        <textarea name="privacy_policy" class="form-control" id="privacy_policy" rows="3" placeholder="Enter Privacy Policy">{{ $config->privacy_policy ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="terms_conditions">Terms & Conditions</label>
                                        <textarea name="terms_conditions" class="form-control" id="terms_conditions" rows="3" placeholder="Enter Terms and Conditions">{{ $config->terms_conditions ?? '' }}</textarea>
                                    </div>
                                </div>

                                <!-- SMTP Settings -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_host">SMTP Host</label>
                                        <input type="text" name="smtp_host" class="form-control" id="smtp_host" value="{{ $config->smtp_host ?? '' }}" placeholder="Enter SMTP Host">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_port">SMTP Port</label>
                                        <input type="text" name="smtp_port" class="form-control" id="smtp_port" value="{{ $config->smtp_port ?? '' }}" placeholder="Enter SMTP Port">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_username">SMTP Username</label>
                                        <input type="text" name="smtp_username" class="form-control" id="smtp_username" value="{{ $config->smtp_username ?? '' }}" placeholder="Enter SMTP Username">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_password">SMTP Password</label>
                                        <input type="password" name="smtp_password" class="form-control" id="smtp_password" value="{{ $config->smtp_password ?? '' }}" placeholder="Enter SMTP Password">
                                    </div>
                                </div>

                                <!-- Appearance Settings -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="font_family">Font Family</label>
                                        <input type="text" name="font_family" class="form-control" id="font_family" value="{{ $config->font_family ?? '' }}" placeholder="Enter Font Family">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="background_color">Background Color</label>
                                        <input type="text" name="background_color" class="form-control" id="background_color" value="{{ $config->background_color ?? '' }}" placeholder="Enter Background Color">
                                    </div>
                                </div>

                                <!-- SEO Settings -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" value="{{ $config->meta_keywords ?? '' }}" placeholder="Enter Meta Keywords">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3" placeholder="Enter Meta Description">{{ $config->meta_description ?? '' }}</textarea>
                                    </div>
                                </div>

                                <!-- Other Configuration -->
                                <div class="col-md-6 col-lg-6 d-none">
                                    <div class="form-group">
                                        <label for="timezone">Timezone</label>
                                        <input type="text" name="timezone" class="form-control" id="timezone" value="{{ $config->timezone ?? '' }}" placeholder="Enter Timezone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 d-none">
                                    <div class="form-group">
                                        <label for="currency">Currency</label>
                                        <input type="text" name="currency" class="form-control" id="currency" value="{{ $config->currency ?? '' }}" placeholder="Enter Currency">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="maintenance_mode">Maintenance Mode</label>
                                    <input type="checkbox" name="maintenance_mode" id="maintenance_mode" value="1" {{ $config->maintenance_mode ? 'checked' : '' }}>
                                </div>


                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Save Settings</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
