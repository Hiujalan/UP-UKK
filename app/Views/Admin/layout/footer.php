    <!-- footer start-->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 footer-copyright text-center">
                    <p class="mb-0">Copyright 2021 © Cuba theme by pixelstrap </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- modal -->
    <div class="modal fade" id="autoReconcile" tabindex="-1" role="dialog" aria-labelledby="autoReconcile" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Find Entries to reconcile Automatically</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">From</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text">
                        </div>
                        <label class="col-sm-1 col-form-label">To</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Reconcile</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Accounts</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Partners</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Discard</button>
                    <button class="btn btn-primary" type="button">Launch</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lockDates" tabindex="-1" role="dialog" aria-labelledby="lockDates" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Find Entries to reconcile Automatically</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Management Closing</h6>
                            <hr>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Journal Entries Lock Date</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Tax Return Lock Date</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h6>Accounting Period Closing</h6>
                            <hr>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">All User Lock Date</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Discard</button>
                    <button class="btn btn-primary" type="button">Launch</button>
                </div>
            </div>
        </div>
    </div>