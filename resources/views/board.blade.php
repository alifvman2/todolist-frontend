<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Board Todo List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none; 
        }
    </style>
</head>
<body>
    <nav class ="navbar-light bg-light">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Todo List</h3>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="rounded-circle" width="48" height="48">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li class="px-3 py-2">
                                <strong>{{ Auth::user() ? Auth::user()->name : 'Guest' }}</strong><br>
                                <small>{{ Auth::user() ? Auth::user()->email : 'Guset@gmail.com' }}</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @if(Auth::check())
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container d-flex flex-row gap-4 mt-3 overflow-x-auto hide-scrollbar"> 
        <div id="container" class="row d-flex justify-content-start gap-3 flex-row flex-nowrap">
            <div class="card" id="card1" style="width: 18rem;">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <h5>Today</h5>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="todayDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="todayDropdown">
                                <div class="d-flex flex-row">
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card1', '#dc3545')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#dc3545;border-radius:6px;"></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card1', '#0d6efd')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#0d6efd;border-radius:6px;"></span> 
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card1', '#198754')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#198754;border-radius:6px;"></span> 
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card1', '#6c757d')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#6c757d;border-radius:6px;"></span> 
                                        </button>
                                    </li>
                                </div>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item p-1 align-center" onclick="setCardBg('card1', 'transparent')">
                                        Reset
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="card1-body" class="mb-2">

                    </div>
                    <div class="input-group d-none" id="input-group-1">
                        <input type="text" id="input-1" class="form-control" data-idCard="card1" data-target="card1-body" onkeyup="if(event.key === 'Enter') tambahCard(this)" placeholder="Tambah card...">
                        <button class="btn btn-outline-secondary" type="button" onclick="hideInput('input-1')">Batal</button>
                    </div>
                    <button class="btn btn-transparent mb-2" onclick="toggleInput('input-group-1')">+ Add a Card</button>
                </div>
            </div>
            <div class="card" id="card2" style="width: 18rem;">
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <h5>This Week</h5>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="weekDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="weekDropdown">
                                <div class="d-flex flex-row">
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card2', '#dc3545')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#dc3545;border-radius:6px;"></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card2', '#0d6efd')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#0d6efd;border-radius:6px;"></span> 
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card2', '#198754')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#198754;border-radius:6px;"></span> 
                                        </button>
                                    </li>
                                    <li>
                                        <button class="dropdown-item p-1" onclick="setCardBg('card2', '#6c757d')">
                                            <span style="display:inline-block;width:32px;height:32px;background:#6c757d;border-radius:6px;"></span> 
                                        </button>
                                    </li>
                                </div>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <button class="dropdown-item p-1 align-center" onclick="setCardBg('card2', 'transparent')">
                                        Reset
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="card2-body" class="mb-2">

                    </div>
                    <div class="input-group d-none" id="input-group-2">
                        <input type="text" id="input-2" class="form-control" data-idCard="card2" data-target="card2-body" onkeyup="if(event.key === 'Enter') tambahCard(this)" placeholder="Tambah card...">
                        <button class="btn btn-outline-secondary" type="button" onclick="hideInput('input-2')">Batal</button>
                    </div>
                    <button class="btn btn-transparent mb-2" onclick="toggleInput('input-group-2')">+ Add a Card</button>
                </div>
            </div>
        </div>
        <div style="width: 18rem;">
            <div class="card d-none" id="addListCard" style="width: 18rem;">
                <div class="card-body">
                    <input type="text" placeholder="Add a new list..." class="form-control" onkeyup="if(event.key === 'Enter') /* your add logic here */" id="newListInput">
                    <div class="d-flex flex-row">
                        <button class="btn btn-primary mt-2" onclick="addNewList()">Add List</button>
                        <button class="btn btn-transparent mt-2" type="button" onclick="hideAddListCard()">X</button>
                    </div>
                </div>
            </div>
            <button id="btnAddAnother" class="card btn text-start" style="width: 18rem;" onclick="toggleAddListCard()">+ Add Another List</button>
        </div>
    </div>

    <div class="modal fade" id="cardModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cardModalTitle">Card Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="cardModalContent">Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveCardChanges()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function setCardBg(cardId, color) {
            document.getElementById(cardId).style.backgroundColor = color;
            localStorage.setItem(`cardBg_${cardId}`, color); // Simpan per card
        }

        // Load saved colors
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.custom-card').forEach(card => {
            const savedColor = localStorage.getItem(`cardBg_${card.id}`);
            if (savedColor) 
                card.style.backgroundColor = savedColor;
            });
        });

        function toggleInput(groupId) {
            const group = document.getElementById(groupId);
            group.classList.toggle('d-none');
            if (!group.classList.contains('d-none')) {
                group.querySelector('input').focus();
            }
        }

        function hideInput(inputId) {
            const input = document.getElementById(inputId);
            if (input) {
                input.value = '';
                if (input.parentElement.classList.contains('input-group')) {
                    input.parentElement.classList.add('d-none');
                } else {
                    input.classList.add('d-none');
                }
            }
        }

        function tambahCard(data) {
            if (event) event.preventDefault();

            const value = (typeof data === 'object') ? data.value.trim() : data.trim();
            const idCard = (typeof data === 'object') ? data.getAttribute('data-idCard') : null;
            const idInput = (typeof data === 'object') ? data.id : null;
            const targetContainerId = (typeof data === 'object') ? data.getAttribute('data-target') : 'default-container';

            if (!value) {
                alert('Input tidak boleh kosong!');
                return;
            }

            const card = document.createElement('div');
            card.className = 'card mb-2';
            card.innerHTML = `
                <div class="card-body d-flex gap-2 align-items-center">
                    <input type="checkbox" class="form-check-input checklist-card" onclick="event.stopPropagation()" onchange="handleChecklist(this, '${idCard}')">
                    <div class="flex-grow-1 btn p-0 text-start" data-bs-toggle="modal" data-bs-target="#cardModal" onclick="showCardDetail('${value}', '${idCard}')">
                        <span>${value}</span>
                    </div>
                </div>
            `;

            const cardContainer = document.querySelector(`#${targetContainerId}`);
            cardContainer.appendChild(card);

            if (typeof data === 'object' && data.tagName === 'INPUT') {
                data.value = '';
                hideInput(data.id);
            }

            sendCardData({ value, idCard, idInput, isChecked: false });
        }

        function handleChecklist(checkbox, idInput) {
            const card = checkbox.closest('.card');
            
            // Kirim status ke server jika diperlukan
            updateChecklistStatus(idInput, checkbox.checked);
        }

        function sendCardData(value, idCard, idInput, isChecked) {
            let formData = new FormData();
            formData.append('value', value);
            formData.append('idInput', idInput || 'default');
            formData.append('idCard', idCard || 'default');

            let url = formMode === 'add' ? `/crm/reguler/edit/${formId}` : '/crm/reguler/create';

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Data berhasil disimpan:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim data.\n' + xhr.responseText);
                }
            });
        }

        function updateChecklistStatus(idInput, isChecked) {
            $.ajax({
                url: '/update-checklist-status',
                method: 'POST',
                data: {
                    idInput: idInput,
                    isChecked: isChecked,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Status checklist diperbarui');
                }
            });
        }

        function showCardDetail(value, idCard) {
            document.getElementById('cardModalTitle').textContent = value;
            document.getElementById('cardModalContent').textContent = value;
        }

        function toggleAddListCard() {
            const card = document.getElementById('addListCard');
            const btnAddAnother = document.getElementById('btnAddAnother');
            if (card.classList.contains('d-none')) {
                card.classList.remove('d-none');
                btnAddAnother.classList.add('d-none');
            } else {
                card.classList.add('d-none');
                btnAddAnother.classList.remove('d-none');
                card.querySelector('input').value = '';
            }
        }

        function hideAddListCard() {
            const card = document.getElementById('addListCard');
            const btnAddAnother = document.getElementById('btnAddAnother');
            card.classList.add('d-none');
            btnAddAnother.classList.remove('d-none');
            document.getElementById('newListInput').value = '';
        }

        function addNewList() {
            const newListInput = document.getElementById('newListInput');
            const listName = newListInput.value.trim();
            if (!listName) {
                alert('List name cannot be empty!');
                return;
            }
            // Generate unique IDs for the new card
            const cardId = 'card-' + Date.now();
            const inputGroupId = 'input-group-' + cardId;
            const inputId = 'input-' + cardId;
            const bodyId = cardId + '-body';
            const dropdownId = cardId + '-dropdown';
            // Create a new list card
            const newCard = document.createElement('div');
            newCard.className = 'card';
            newCard.style.width = '18rem';
            newCard.id = cardId;
            newCard.innerHTML = `
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <h5>${listName}</h5>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="${dropdownId}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="${dropdownId}">
                                <div class="d-flex flex-row">
                                    <li><button class="dropdown-item p-1" onclick="setCardBg('${cardId}', '#dc3545')"><span style="display:inline-block;width:32px;height:32px;background:#dc3545;border-radius:6px;"></span></button></li>
                                    <li><button class="dropdown-item p-1" onclick="setCardBg('${cardId}', '#0d6efd')"><span style="display:inline-block;width:32px;height:32px;background:#0d6efd;border-radius:6px;"></span></button></li>
                                    <li><button class="dropdown-item p-1" onclick="setCardBg('${cardId}', '#198754')"><span style="display:inline-block;width:32px;height:32px;background:#198754;border-radius:6px;"></span></button></li>
                                    <li><button class="dropdown-item p-1" onclick="setCardBg('${cardId}', '#6c757d')"><span style="display:inline-block;width:32px;height:32px;background:#6c757d;border-radius:6px;"></span></button></li>
                                </div>
                                <li><hr class="dropdown-divider"></li>
                                <li><button class="dropdown-item p-1 align-center" onclick="setCardBg('${cardId}', 'transparent')">Reset</button></li>
                            </ul>
                        </div>
                    </div>
                    <div id="${bodyId}" class="mb-2"></div>
                    <div class="input-group d-none" id="${inputGroupId}">
                        <input type="text" id="${inputId}" class="form-control" data-idCard="${cardId}" data-target="${bodyId}" onkeyup="if(event.key === 'Enter') tambahCard(this)" placeholder="Tambah card...">
                        <button class="btn btn-outline-secondary" type="button" onclick="hideInput('${inputId}')">Batal</button>
                    </div>
                    <button class="btn btn-transparent mb-2" onclick="toggleInput('${inputGroupId}')">+ Add a Card</button>
                </div>
            `;
            const container = document.getElementById('container');
            container.append(newCard);

            newListInput.value = '';
            hideAddListCard();
        }
    </script>
</body>
</html>