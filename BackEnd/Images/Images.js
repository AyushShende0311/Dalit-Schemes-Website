function removeImg(){
    var btns = document.querySelectorAll(".remove-btn");
    if(btns){
        btns.forEach(btn=>{
            btn.addEventListener("click",()=>{
                var parent = btn.parentElement;
                parent.remove();
            })
        });
    }
    
}

function addImageUploader(){

    var target = document.getElementById("image-upload-target");
    var input = ` <div class="mb-3">
                    <label  class="form-label">Upload Images</label><br>
                    <input type="file" name="files[]"  enctype="multipart/form-data">
                    <div class="remove-btn btn btn-danger">Remove</div>
                </div>`;

    target.insertAdjacentHTML("beforebegin", input);
    removeImg();
}
