
    function saveMenuItem(container) {

        const rows = container.querySelectorAll('[data-row]');

        const formData = new FormData();

        rows.forEach((row, index) => {

            let name  = row.querySelector('[data-name]').value,
                url   = row.querySelector('[data-url]').value,
                order = row.querySelector('[data-order]').value,
                type  = row.querySelector('[data-type]').value;

            if (name && url && order && type){
                formData.append(`items[${index}][name]`, row.querySelector('[data-name]').value);
                formData.append(`items[${index}][url]`, row.querySelector('[data-url]').value);
                formData.append(`items[${index}][order]`, row.querySelector('[data-order]').value);
                formData.append(`items[${index}][type]`, row.querySelector('[data-type]').value);
            }
        });

        fetch('/s/savemenuitem', {
            method: 'POST',
            body: formData
        })
            .then(r => r.json())
            .then(out => {
                document.getElementById('result').innerText = JSON.stringify(out, null, 2);
            });
    }

    function deleteItem(element) {
        element.closest('.input-group').remove();
    }

    function addEventListenerDeleteButton(btn) {
        btn.addEventListener('click', (e) => {
            deleteItem(e.target)
        });
    }

    function eventListener(container) {

        const element = container.querySelector('[data-add]')
        const deleteButtons = container.querySelectorAll('[data-delete]')
        const saveButton = container.querySelector('[data-save]');

        saveButton.addEventListener('click', function () {
            saveMenuItem(container)
        });

        deleteButtons.forEach((btn) => {
            addEventListenerDeleteButton(btn)
        });

        element.addEventListener('click', function () {
            addMenuItem(container)
        });
    }
    function addMenuItem(container) {

            const newItem = document.createElement('div');

            newItem.classList.add('input-group', 'sortable-no-reorder', 'mb-3', 'pb-3');
            newItem.innerHTML = `
               <div class="row g-0" data-row>
                    <div class="col-md-4 pr-0 pl-0" style="display: flex; flex-direction: row; ">
                        <span data-delete class="input-group-addon preaddon" style="display: flex; justify-content: center; align-items: center; border-radius: 0;">x</span>
                        <input data-name type="text" class="form-control"  placeholder="Name" value="" style="border-radius: 0;">
                    </div>
                    <div class="col-md-4 pr-0 pl-0">
                        <input data-url type="text" class="form-control"    placeholder="URL" value="">
                    </div>
                    <div class="col-md-2 pr-0 pl-0">
                        <input data-order type="number" class="form-control"   placeholder="Sort" value="">
                    </div>
                    <div class="col-md-2 pr-0 pl-0">
                        <select data-type class="form-control form-select" >
                            <option value="blank" {% if item.type == 'blank' %}selected{% endif %}>Blank</option>
                            <option value="iFrame" {% if item.type == 'iFrame' %}selected{% endif %}>iFrame</option>
                        </select>
                    </div>
                </div>
            `;

            container.appendChild(newItem);

            deleteButton = newItem.querySelector('[data-delete]');

            addEventListenerDeleteButton(deleteButton);
        }



window.addEventListener('load', () => {
    const container = document.querySelector('[data-leuchtfeuer-custom-navlinks-bundle-container]');

    if (container) {
        setTimeout(() => eventListener(container), 300);
    }
});