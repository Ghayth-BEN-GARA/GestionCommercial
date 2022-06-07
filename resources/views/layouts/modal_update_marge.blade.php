<div class = "modal modalfade " id = "exampleModalCenter" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalCenterTitle" aria-hidden = "true">
	<div class = "modal-dialog modal-dialog-centered" role = "document">
	    <div class = "modal-content">
		    <div class = "modal-header">
		        <button type = "button" class = "close d-flex align-items-center justify-content-center" data-dismiss = "modal" aria-label = "Close">
		            <span aria-hidden = "true" class = "mdi mdi-close"></span>
		        </button>
		    </div>
		    <div class = "modal-body p-4">
		      	<div class = "icon d-flex align-items-center justify-content-center">
		      		<span class = "mdi mdi-exclamation"></span>
		      	</div>
		      	<h3 class = "text-center mb-4">Marge des prix</h3>
                <p class = "text-center mb-4">Veuillez entrer la marge souhaitée pour mettre à jour le prix de vente.</p>
		      	<form class = "forms-sample" id = "f" name = "f" method = "post" action = "{{url('/update-marge')}}">
                    @csrf
                    <div class = "form-group row">
                        <label for = "exampleInputUsername2" class = "col-sm-3 col-form-label">Référence</label>
                        <div class = "col-sm-9">
                            <input type = "text" class = "form-control rounded-left" id = "reference" name = "reference" placeholder = "Saisissez le référence.." readonly required>
                        </div>
		      		</div>
	                <div class = "form-group row">
                        <label for = "exampleInputUsername2" class = "col-sm-3 col-form-label">Marge (%)</label>
                        <div class = "col-sm-9">
                            <input type = "number" class = "form-control rounded-left" id = "marge" name = "marge" placeholder = "Saisissez la nouvelle marge.." required>
                        </div>
		      		</div>
                    <div class = "col-md-12 text-center">
	            	    <button type = "submit" class = "btn btn-primary me-2" id = "btn_submit">Mettre à jour</button>
                    </div>
	            </form>
		    </div>
		</div>
	</div>
</div>