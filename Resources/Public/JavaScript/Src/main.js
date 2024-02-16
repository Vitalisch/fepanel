var counter = 1;
function add_more() {
    counter++
    var newDiv = `<div class="card card-body mt-2">
            <h2>Add Url</h2>
            <div>
                <label for="title0" class="form-label">Enter Title1</label>
                <f:form.textfield name="title[]" id="title0" class="form-control" value="{setting.links.title.0}" />
            </div>
            <div class="mt-2">
                <label for="url0" class="form-label">Enter Link1</label>
                <f:form.textfield type="url" name="url[]" id="url0" class="form-control" value="{setting.links.url.0}" />
            </div>
            <div>
                <label for="title1" class="form-label">Enter Title2</label>
                <f:form.textfield name="title[]" id="title1" class="form-control" value="{setting.links.title.1}" />
            </div>
            <div class="mt-2">
                <label for="url1" class="form-label">Enter Link2</label>
                <f:form.textfield type="url" name="url[]" id="url1" class="form-control" value="{setting.links.url.1}" />
            </div>
        </div>`
    var form = document.getElementById('input-form')
    form.insertAdjacentHTML('beforeend', newDiv);
}

function delete_row(id) {
    document.getElementById('product_row'+id).remove()
}

function submit_form() {
    var productData = []
    for (var i = 1; i <= counter; i++){
        var product_row = document.getElementById('product_row'+i)
        if (product_row) {
            var product_name = document.getElementById('name' + i).value
            var price = document.getElementById('price' + i).value
            var data = {
                name: product_name,
                price: price
            }
            productData.push(data)
        }
    }

    axios.post('/dynamicinput/submitform.php', {
        productData: productData
    }).then(resp => {
        window.location.reload()
    })
}
