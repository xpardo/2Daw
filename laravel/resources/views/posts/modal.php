<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            This action cannot be undone
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="confirm" type="button" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit confirm -->
            <script type="text/javascript">                
                const submit = document.getElementById('destroy')
                const  confirm = document.getElementById('confirm')

                // Disable form submit button
                submit.addEventListener("click", function( event ) {
                    event.preventDefault()
                    return false
                })

                // Enable submit via modal confirmation
                confirm.addEventListener("click", function( event ) {
                    document.getElementById("form").submit(); 
                })
            </script>