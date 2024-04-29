<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Sortable - Connect lists</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/tasks.css">
    <style>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
    <button onclick="toggleModal()">Add Task Group</button>
    <div id="modal" class="new-task-group-modal">
        <div class="new-task-group-modal-content">
            <div class="close" onclick="closeModal()">&times;</div>

            <div>
                <input type="text" id="newTaskGroupTitle" placeholder="Label - Todo, Live, Done...">
            </div>

            <div id="colorOptions" class="new-task-group-colors">
                <!-- Color options will be dynamically generated here -->
            </div>

            <div>
                <button onclick="addNewtaskCat()" class="btn-check">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="task-groups-container">
        <div class="task-group" class="ui-state-default">
            <ul id="sortable1" class="task-group-box pending-task-box ui-state-default portlet">
                <h4 class="portlet-header ui-state-disabled">Pending</h4>
                <li class="ui-state-default candidate-box">Item 1</li>
                <li class="ui-state-default candidate-box">Item 2</li>
                <li class="ui-state-default candidate-box">Item 3</li>
            </ul>
        </div>
        <div class="task-group" class="ui-state-default">
            <ul id="sortable2" class="task-group-box interview-task-box ui-state-default portlet">
                <h4 class="portlet-header ui-state-disabled">Live</h4>
                <li class="ui-state-default candidate-box">Item 1</li>
                <li class="ui-state-default candidate-box">Item 2</li>
                <li class="ui-state-default candidate-box">Item 3</li>
            </ul>
        </div>
        <div class="task-group" class="ui-state-default">
            <ul id="sortable3" class="task-group-box test-task-box ui-state-default portlet">
                <h4 class="portlet-header ui-state-disabled">Done</h4>
                <li class="ui-state-default candidate-box">Item 1</li>
                <li class="ui-state-default candidate-box">Item 2</li>
                <li class="ui-state-default candidate-box">Item 3</li>
                <li class="ui-state-default candidate-box">Item 4</li>
            </ul>
        </div>
    </div>
    
    <script>
        $(function() {
            $(".task-cats-container").sortable({
                connectWith: ".task-cats-container",
                placeholder: "ui-state-highlight"
            });
            $(".task-group-box").sortable({
                connectWith: ".task-group-box",
                placeholder: "ui-state-highlight"
            }).disableSelection();

            // Color options array with light and deep values
            var colorOptions = [
                { id: 'red', light: '#ffcccc', deep: '#cc0000' },
                { id: 'blue', light: '#cce6ff', deep: '#0000cc' },
                { id: 'green', light: '#ccffcc', deep: '#006600' },
                { id: 'yellow', light: '#ffffcc', deep: '#cccc00' }
            ];

            // Generate radio buttons for color options
            var colorOptionsHTML = '';
            var count =1;
            colorOptions.forEach(function(color) {
                if(count==1){checked='checked'}else{checked=''};
                colorOptionsHTML += `
                    <label for="group-color-${color.id}">
                        <input type="radio" name="color" class="task-group-color-option" id="group-color-${color.id}" value="${color.id}" ${checked}>
                        <span class="color-option" style="background-color: ${color.light}">
                            <span class="checkmark">&#10003;</span> <!-- Checkmark icon -->
                        </span>
                    </label>`;
                count++;
            });
            $('#colorOptions').html(colorOptionsHTML);
        });

        function toggleModal() {
            var modal = $("#modal");
            if (modal.css("display") === "none") {
                openModal();
            } else {
                closeModal();
            }
        }

        function openModal() {
            $("#modal").css("display", "block");
        }

        function closeModal() {
            $("#modal").css("display", "none");
        }

        function addNewtaskCat() {
            var newCatName = $("#newTaskGroupTitle").val();
            var newCatColor = $("input[name='color']:checked").val();
            if (newCatName !== "" && newCatColor !== undefined) {
                var container = $(".task-groups-container");
                var newCatId = container.children().length + 1;
                var newCatHTML = `
                    <div class="task-group ">
                        <ul id="sortable${newCatId}" class="task-group-box ui-state-default test-task-box ${newCatColor} portlet">
                            <h4 class="portlet-header ui-state-disabled">${newCatName}</h4>
                        </ul>
                    </div>`;
                container.append(newCatHTML);
                closeModal();
                $(".task-group-box").sortable({
                    connectWith: ".task-group-box",
                    placeholder: "ui-state-highlight"
                }).disableSelection();
            } else {
                alert("Please enter a valid category name and select a color.");
            }
        }
    </script>
</body>

</html>
