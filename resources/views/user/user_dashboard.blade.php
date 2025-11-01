<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>4notes - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container-fluid">
    <div class="row">

      <!-- Mobile Overlay -->
      <div class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-none" id="sidebar-overlay" style="z-index: 1040;" onclick="closeSidebar()"></div>

      <!-- Sidebar -->
      <div id="sidebar" class="col-md-3 col-12 bg-dark text-white vh-100 position-sticky top-0 d-flex flex-column shadow" style="overflow: hidden;">
        
        <!-- Header -->
        <div class="p-3 pb-2 flex-shrink-0">
          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-center flex-grow-1">
              <i class="bi bi-book text-warning fs-4 me-2"></i>
              <h5 class="mb-0 fw-normal fs-4">4notes</h5>
            </div>
            <a href="profile.html" class="text-white text-decoration-none fs-4" title="Profile">
              <i class="bi bi-person-gear"></i>
            </a>
          </div>
        </div>

        <!-- Controls -->
        <div class="px-3 pb-3 flex-shrink-0">
          <div class="d-flex gap-2">
            <!-- Search -->
            <div class="flex-grow-1 position-relative">
              <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-white-50"></i>
              <input type="text" id="searchInput" class="form-control bg-dark bg-opacity-25 border border-white border-opacity-25 text-white ps-5 rounded-3" placeholder="Search...">
            </div>

            <!-- New Note Button -->
            <button class="btn btn-warning text-white px-3 rounded-3" onclick="showCreateNote()" title="Create new note">
              <i class="bi bi-plus-lg fs-5"></i>
            </button>
          </div>
        </div>

        <!-- Notes List -->
        <div class="flex-grow-1 px-3 pb-3" style="overflow-y: auto;">
          <div class="text-white-50 text-uppercase small fw-semibold mb-3 opacity-75" style="letter-spacing: 1.2px; font-size: 0.7rem;">Recent Notes</div>
          <div class="d-flex flex-column gap-3" id="notesList">
            <!-- Notes will be loaded here dynamically -->
          </div>
        </div>

      </div>

      <!-- Main Content -->
      <div id="main-content" class="col-md-9 col-12 bg-light d-flex flex-column" style="min-height: 100vh;">

        <!-- Mobile Toggle -->
        <div class="d-md-none p-3 bg-white border-bottom sticky-top" style="z-index: 100;">
          <button class="btn btn-outline-dark rounded-3 d-flex align-items-center gap-2" type="button" onclick="toggleSidebar()">
            <i class="bi bi-list fs-4"></i>
            <span>Menu</span>
          </button>
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="flex-grow-1 d-flex align-items-center justify-content-center p-5">
          <div class="text-center" style="max-width: 500px;">
            <div class="bg-light border rounded-4 d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 120px; height: 120px;">
              <i class="bi bi-journal-text text-secondary" style="font-size: 3.5rem;"></i>
            </div>
            <h3 class="fw-normal mb-3" style="letter-spacing: -0.5px;">No Note Selected</h3>
            <p class="text-secondary mb-4 fs-6">Choose a note from the sidebar to view its contents, or create a new note to get started.</p>
            <button class="btn btn-dark rounded-3 px-4 py-3" onclick="showCreateNote()">
              <i class="bi bi-plus-lg me-2"></i>Create Your First Note
            </button>
          </div>
        </div>

        <!-- Create Note Form -->
        <div id="create-note" class="flex-grow-1 d-none d-flex align-items-center justify-content-center p-5">
          <div class="w-100" style="max-width: 900px;">
            <div class="mb-4">
              <h2 id="createNoteTitle" class="fw-normal mb-2" style="font-size: 2.25rem; letter-spacing: -1px;">Create a New Note</h2>
              <p id="createNoteSubtitle" class="text-secondary fs-6">Write down your thoughts, ideas, or important information.</p>
            </div>
            
            <div class="mb-4">
              <input type="text" class="form-control bg-white border-2 rounded-3 p-3" id="noteTitle" placeholder="Note title...">
            </div>
            
            <div class="mb-4">
              <textarea class="form-control bg-white border-2 rounded-3 p-3" id="noteContent" placeholder="Start writing your note here..." rows="12"></textarea>
            </div>
            
            <div class="d-flex gap-3">
              <button class="btn btn-dark rounded-3 px-4 py-2" id="saveBtn" onclick="createNote()">
                <i class="bi bi-check-lg me-2"></i>Save Note
              </button>
              <button class="btn btn-outline-secondary rounded-3 px-4 py-2" onclick="showEmptyState()">Cancel</button>
            </div>
          </div>
        </div>

        <!-- Note Viewer -->
        <div id="note-viewer" class="flex-grow-1 d-none d-flex align-items-center justify-content-center p-5" data-note-id="">
          <div class="w-100" style="max-width: 900px;">
            <div class="mb-4">
              <div class="d-flex flex-column flex-md-row align-items-start justify-content-between gap-3 mb-3">
                <h1 class="fw-normal mb-0 flex-grow-1" id="noteViewerTitle" style="font-size: 2.5rem; letter-spacing: -1px;">Note Title</h1>
                <div class="d-flex gap-2">
                  <button class="btn btn-outline-secondary rounded-2 d-flex align-items-center gap-2 small" onclick="showEditNote()">
                    <i class="bi bi-pencil"></i>
                    <span>Edit</span>
                  </button>
                  <button class="btn btn-outline-secondary rounded-2 d-flex align-items-center gap-2 small" onclick="deleteCurrentNote()">
                    <i class="bi bi-archive"></i>
                    <span>Archive</span>
                  </button>
                </div>
              </div>
              
              <div class="text-secondary d-flex align-items-center gap-2 mb-4" id="noteMeta">
                <i class="bi bi-calendar3"></i>
                <span></span>
              </div>
            </div>
            
            <hr class="border-2 my-4">
            
            <div class="fs-6 lh-lg" id="noteViewerContent" style="color: #2d2d2d;">
              <!-- Note content will be displayed here -->
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    let currentNoteId = null;

    // Mobile Sidebar Toggle
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        if (sidebar.classList.contains('position-fixed')) {
            sidebar.classList.remove('position-fixed', 'start-0');
            overlay.classList.add('d-none');
            document.body.style.overflow = '';
        } else {
            sidebar.classList.add('position-fixed', 'start-0');
            sidebar.style.zIndex = '1050';
            sidebar.style.maxWidth = '320px';
            sidebar.style.width = '80%';
            overlay.classList.remove('d-none');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.remove('position-fixed', 'start-0');
        overlay.classList.add('d-none');
        document.body.style.overflow = '';
    }

    // UI State Management
    function showCreateNote() {
        document.getElementById('empty-state').classList.add('d-none');
        document.getElementById('note-viewer').classList.add('d-none');
        document.getElementById('create-note').classList.remove('d-none');

        // Reset form for creating new note
        document.getElementById('createNoteTitle').textContent = 'Create a New Note';
        document.getElementById('createNoteSubtitle').textContent = 'Write down your thoughts, ideas, or important information.';
        document.getElementById('noteTitle').value = '';
        document.getElementById('noteContent').value = '';
        document.getElementById('saveBtn').innerHTML = '<i class="bi bi-check-lg me-2"></i>Save Note';
        document.getElementById('saveBtn').setAttribute('onclick', 'createNote()');
        currentNoteId = null;

        // Close sidebar on mobile
        if (window.innerWidth < 768) {
            closeSidebar();
        }
    }

    function showEmptyState() {
        document.getElementById('empty-state').classList.remove('d-none');
        document.getElementById('note-viewer').classList.add('d-none');
        document.getElementById('create-note').classList.add('d-none');
        currentNoteId = null;

        // Remove active state from all notes
        document.querySelectorAll('.note-item').forEach(item => {
            item.classList.remove('border-warning', 'bg-warning', 'bg-opacity-10');
        });
    }

    function showNoteViewer() {
        document.getElementById('empty-state').classList.add('d-none');
        document.getElementById('create-note').classList.add('d-none');
        document.getElementById('note-viewer').classList.remove('d-none');

        // Close sidebar on mobile
        if (window.innerWidth < 768) {
            closeSidebar();
        }
    }

    // Load all notes
    function loadNotes() {
        $.get('dashboard.php', function (response) {
            if (response.success) {
                const notesList = $('#notesList');
                notesList.empty();

                if (response.notes.length === 0) {
                    notesList.append(`
                      <div class="text-center text-white-50 p-3">
                        No notes found. Create your first note!
                      </div>
                    `);
                    return;
                }

                response.notes.forEach(note => {
                    const date = new Date(note.updated_at || note.created_at);
                    const previewText = note.content.substring(0, 100) + (note.content.length > 100 ? '...' : '');

                    notesList.append(`
                      <button class="note-item btn text-start bg-dark bg-opacity-25 border border-white border-opacity-10 text-white rounded-3 p-3 w-100" onclick="openNote(${note.id})" style="transition: all 0.3s ease;">
                        <div class="fw-medium mb-2">${escapeHtml(note.title)}</div>
                        <div class="text-white-50 small mb-2" style="line-height: 1.4;">${escapeHtml(previewText)}</div>
                        <div class="text-white-50 d-flex align-items-center gap-2" style="font-size: 0.75rem;">
                          <i class="bi bi-calendar3"></i>
                          <span>${formatDate(date)}</span>
                        </div>
                      </button>
                    `);
                });
            }
        }).fail(function () {
            alert('Failed to load notes. Please refresh the page.');
        });
    }

    // Create note
    function createNote() {
        const title = $('#noteTitle').val().trim();
        const content = $('#noteContent').val().trim();

        if (!title || !content) {
            alert('Please enter both title and content');
            return;
        }

        $.ajax({
            url: 'dashboard.php',
            type: 'POST',
            data: JSON.stringify({ title, content }),
            contentType: 'application/json',
            success: function (response) {
                if (response.success) {
                    alert('Note created successfully!');
                    loadNotes();
                    showEmptyState();
                } else {
                    alert(response.message || 'Failed to create note');
                }
            },
            error: function () {
                alert('Failed to create note');
            }
        });
    }

    // Open note
    function openNote(noteId) {
        $.get(`dashboard.php?id=${noteId}`, function (response) {
            if (response.success && response.notes[0]) {
                const note = response.notes[0];
                const date = new Date(note.created_at);

                $('#noteViewerTitle').text(note.title);
                $('#noteViewerContent').html(escapeHtml(note.content).replace(/\n/g, '<br>'));
                $('#noteMeta span').text(formatDateTime(date));
                $('#note-viewer').attr('data-note-id', note.id);
                currentNoteId = note.id;

                // Add active state to selected note
                $('.note-item').removeClass('border-warning bg-warning bg-opacity-10');
                $(`.note-item[onclick="openNote(${noteId})"]`).addClass('border-warning bg-warning bg-opacity-10');

                showNoteViewer();
            }
        }).fail(function () {
            alert('Failed to load note');
        });
    }

    // Show edit note
    function showEditNote() {
        if (!currentNoteId) return;

        const title = $('#noteViewerTitle').text();
        const content = $('#noteViewerContent').text();

        $('#createNoteTitle').text('Edit Note');
        $('#createNoteSubtitle').text('Update your note with new information.');
        $('#noteTitle').val(title);
        $('#noteContent').val(content);
        $('#saveBtn').html('<i class="bi bi-check-lg me-2"></i>Update Note').attr('onclick', `updateNote(${currentNoteId})`);

        $('#note-viewer').addClass('d-none');
        $('#create-note').removeClass('d-none');
    }

    // Update note
    function updateNote(noteId) {
        const title = $('#noteTitle').val().trim();
        const content = $('#noteContent').val().trim();

        if (!title || !content) {
            alert('Title and content cannot be empty');
            return;
        }

        $.ajax({
            url: 'dashboard.php',
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify({ id: noteId, title, content }),
            success: function (response) {
                if (response.success) {
                    alert('Note updated successfully!');
                    loadNotes();
                    showEmptyState();
                } else {
                    alert(response.message || 'Failed to update note');
                }
            },
            error: function () {
                alert('Failed to update note');
            }
        });
    }

    // Delete note (move to archive)
    function deleteCurrentNote() {
        if (!currentNoteId) return;

        if (!confirm('Move this note to archive?')) return;

        $.ajax({
            url: `dashboard.php?id=${currentNoteId}`,
            type: 'DELETE',
            success: function (response) {
                if (response.success) {
                    alert('Note moved to archive');
                    loadNotes();
                    showEmptyState();
                } else {
                    alert(response.message || 'Failed to archive note');
                }
            },
            error: function () {
                alert('Failed to archive note');
            }
        });
    }

    // Search functionality
    let searchTimeout;
    $('#searchInput').on('input', function () {
        const searchTerm = $(this).val().trim().toLowerCase();

        clearTimeout(searchTimeout);

        if (searchTerm === '') {
            loadNotes();
            return;
        }

        searchTimeout = setTimeout(() => {
            $.ajax({
                url: `dashboard.php?search=${encodeURIComponent(searchTerm)}`,
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        const notesList = $('#notesList');
                        notesList.empty();

                        if (response.notes.length === 0) {
                            notesList.append(`
                              <div class="text-center text-white-50 p-3">
                                No notes found matching "${escapeHtml(searchTerm)}"
                              </div>
                            `);
                            return;
                        }

                        response.notes.forEach(note => {
                            const date = new Date(note.updated_at || note.created_at);
                            const previewText = note.content.substring(0, 100) + (note.content.length > 100 ? '...' : '');

                            notesList.append(`
                              <button class="note-item btn text-start bg-dark bg-opacity-25 border border-white border-opacity-10 text-white rounded-3 p-3 w-100" onclick="openNote(${note.id})">
                                <div class="fw-medium mb-2">${escapeHtml(note.title)}</div>
                                <div class="text-white-50 small mb-2">${escapeHtml(previewText)}</div>
                                <div class="text-white-50 d-flex align-items-center gap-2" style="font-size: 0.75rem;">
                                  <i class="bi bi-calendar3"></i>
                                  <span>${formatDate(date)}</span>
                                </div>
                              </button>
                            `);
                        });
                    }
                },
                error: function () {
                    alert('Failed to search notes');
                }
            });
        }, 500);
    });

    // Utility functions
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    function formatDate(date) {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return `${months[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()}`;
    }

    function formatDateTime(date) {
        return date.toLocaleString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });
    }

    // Initialize
    $(document).ready(function () {
        loadNotes();
    });
  </script>

  <style>
    /* Minimal inline styles for hover effects that Bootstrap doesn't cover */
    .note-item:hover {
      background-color: rgba(255, 255, 255, 0.1) !important;
      border-color: rgba(255, 179, 128, 0.3) !important;
      transform: translateX(4px);
    }
    
    #searchInput::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }
    
    #searchInput:focus {
      background-color: rgba(255, 255, 255, 0.12) !important;
      border-color: #ffc107 !important;
      color: white !important;
      box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25) !important;
    }
  </style>
</body>
</html>