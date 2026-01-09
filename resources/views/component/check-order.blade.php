<div class="order-search-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 text-center">
                
                <h2 class="fw-bold text-dark mb-4">{{ __('component_check.title') }}</h2>
                <p class="text-muted mb-3">{{ __('component_check.subtitle') }}</p>
                
                <form action="" method="GET">
                    <div class="input-group">
                        <input 
                            type="number" 
                            name="invoice_code" 
                            class="form-control" 
                            placeholder="{{ __('component_check.placeholder') }}"
                            min="1"
                            required
                        >
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="bi bi-search"></i>
                            <span>{{ __('component_check.search') }}</span>
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>