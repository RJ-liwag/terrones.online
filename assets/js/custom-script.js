
// $('document').ready(function () {


//     /******* CONTACT US INSERTION  */
//     (function () {
//         'use strict';

//         var form = document.getElementById('contact-form');

//         form.addEventListener('submit', function (event) {
//             if (!form.checkValidity()) {
//                 event.preventDefault();
//                 event.stopPropagation();

//                 Swal.fire({
//                     title: 'Oops!',
//                     text: 'All fields are required, please double check!',
//                     icon: 'error',
//                     confirmButtonColor: '#e08e0b',
//                     confirmButtonText: 'OK'
//                 });

//                 form.classList.add('was-validated');
//                 return;
//             }

//             event.preventDefault();

//             const formData = new FormData(form);

//             fetch('functions/contact-us/add-inquries.php', {
//                 method: 'POST',
//                 body: formData
//             })
//                 .then(response => response.text())
//                 .then(data => {
//                     if (data == "Successful") {
//                         Swal.fire({
//                             title: 'Success!',
//                             text: 'Request has been successfully submitted!',
//                             icon: 'success',  
//                             confirmButtonColor: '#28a745',
//                             confirmButtonText: 'OK'
//                         }).then(() => {

//                             form.reset();
//                             window.location.reload();
//                         });
//                     } else {
//                         Swal.fire({
//                             title: 'Error!',
//                             text: 'Submission of the request was unsuccessful!',
//                             icon: 'error',
//                             confirmButtonColor: '#e08e0b',
//                             confirmButtonText: 'OK'
//                         });
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Error:', error);
//                     Swal.fire({
//                         title: 'Error!',
//                         text: 'An error occurred during submission. Please try again later.',
//                         icon: 'error',
//                         confirmButtonColor: '#e08e0b',
//                         confirmButtonText: 'OK'
//                     });
//                 });
//         });
//     })();

//       /******* END OF CONTACT US INSERTION  */

// });