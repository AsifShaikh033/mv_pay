@extends('Admin.layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Webhook</h3>
            <ul class="breadcrumbs mb-3">
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Webhook</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Webhook URL with copy option -->
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="webhook_url">Webhook URL</label>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <input 
                                            type="text" 
                                            id="webhookUrl" 
                                            value="{{ url('/recharge_callback') }}" 
                                            readonly 
                                            class="form-control"
                                        />
                                        <button 
                                            onclick="copyWebhookUrl()" 
                                            class="btn btn-success"
                                        >
                                            Copy
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">Copy this and add it in your Cyrus settings</small>
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                    <label for="webhook_url">Webhook For Digital Pay </label>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <input 
                                            type="text" 
                                            id="copyWebhookUrlseconds" 
                                            value="{{ url('/digital_webhook') }}" 
                                            readonly 
                                            class="form-control"
                                        />
                                        <button 
                                            onclick="copyWebhookUrlsecond()" 
                                            class="btn btn-success"
                                        >
                                            Copy
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">Copy this and add it in your Digital settings</small>
                                </div>
                        </div>
                        </div>
                        <!-- New section for displaying API response details -->
                        <div class="row mt-4">
                            <h5>API Response Details</h5>
                            <p><strong>REQUEST PARAMETERS (HTTP GET METHOD)</strong></p>
                            <p> 
                                ?Status=&OperatorRef=&APITransID=&TransID=&ErrorCode=&Amount=
                            </p>
                            <ul>
                                <li><strong>Status:</strong> SUCCESS/FAILED/FAILURE/REFUND</li>
                                <li><strong>OperatorRef:</strong> Operator Reference</li>
                                <li><strong>APITransID:</strong> Cyrus Transaction ID</li>
                                <li><strong>TransID:</strong> Your Transaction ID</li>
                                <li><strong>ErrorCode:</strong> Error Message</li>
                                <li><strong>Amount:</strong> Recharge Amount</li>
                            </ul>
                            <small>Note: Configure Callback Url from setting Callback</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyWebhookUrl() {
        const webhookInput = document.getElementById('webhookUrl');
        webhookInput.select();
        document.execCommand('copy');
        alert('Webhook URL copied to clipboard!');
    }
    function copyWebhookUrlsecond() {
        const webhookInput = document.getElementById('copyWebhookUrlseconds');
        webhookInput.select();
        document.execCommand('copy');
        alert('Webhook URL copied to clipboard!');
    }
</script>
@endsection
