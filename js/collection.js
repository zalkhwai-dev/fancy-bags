function openModal(bag_id) {
    document.getElementById('deleteBagId').value = bag_id;
    document.getElementById('confirmModal').style.display = 'block';
}


function confirmDelete() {
  document.getElementById('deleteForm').submit();
}


function closeModal() {
  document.getElementById('confirmModal').style.display = 'none';
}