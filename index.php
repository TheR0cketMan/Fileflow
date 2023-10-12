<?php
$htdocsPath = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']));

// Check if the current file is index.php or a custom filename
if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
    $currentPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $htdocsPath);
} else {
    // If it's a custom filename, use the directory path
    $currentPath = dirname(str_replace($_SERVER['DOCUMENT_ROOT'], '', $htdocsPath));
}

$currentPath = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'] . $currentPath));
$currentPath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $currentPath);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Onest:wght@200;300;400;500;600;700;800&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&display=swap');
      body {
          font-family: "Inclusive Sans", Sans-serif;
          background-color: #f5f5f5;
          color: #333;
          margin: 0;
          padding: 0;
      }

      .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        padding-top: 60px;
        transition: 0.5s;
      }

      .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
      }

      .sidenav a:hover {
        color: #f1f1f1;
        text-decoration: none;
      }

      .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
      }

      #main {
        transition: margin-left .5s;
        padding: 20px;
      }

      @media screen and (max-height: 450px) {
        .sidenav {
          padding-top: 15px;
        }

        .sidenav a {
          font-size: 18px;
        }
      }

      header {
          background-color: #5224F6;
          color: #ffffff;
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 20px;
      }

      h1 {
        font-family: "Onest", Sans-serif;
        margin: 0;
        font-size: 36px;
        text-align: center;
        flex: 1;
      }

      h4 {
          font-family: "Onest", Sans-serif;
          font-size: 14px;
      }

      .fa-bars {
        font-size: 24px;
      }

      ul {
          list-style-type: none;
          padding: 0;
      }

      li {
          font-size: 18px;
          margin: 10px 0;
          position: relative;
          padding-left: 30px;
          display: flex;
          align-items: center;
      }

      a {
          text-decoration: none;
          color: #4169e1;
          margin-left: 10px;
          flex-grow: 1;
      }

      a:hover {
          text-decoration: underline;
      }

      .fa-file-html,
      .fa-file-image,
      .fa-file-text,
      .fa-file-code,
      .fa-file,
      .fa-folder,
      .fa-file-pdf,
      .fa-vuejs,
      .fa-rust,
      .fa-react,
      .fa-swift,
      .fa-golang,
      .fa-python,
      .fa-git,
      .fa-file-csv,
      .fa-file-excel,
      .fa-file-word,
      .fa-docker,
      .fa-file-audio
       {
          font-size: 24px;
          color: #333;
          margin-right: 10px;
      }

      .fa-markdown {
        font-size: 18px;
        color: #333;
        margin-right: 10px;
      }

      .server-info {
          margin-top: 20px;
          color: #777;
      }

      .dir {
          font-weight: normal;
      }

      .btn {
          color: #fff !important;
          padding: 15px 30px;
          text-decoration: none !important;
          border-radius: 5px;
          display: inline-block;
          font-weight: bold;
          transition: background-color 0.3s ease-in-out;
          margin-top: 50px !important;
          max-width: 30%;
      }

      .btn-success {
          background-color: #49B265;
      }

      .btn-success:hover {
          background-color: #159947;
      }

      .btn-center {
          display: flex;
          justify-content: center;
          align-items: center;
          margin: 0 auto;
      }

      .btn-upload {
        display: flex;
        justify-content: end;
        align-items: end;
        text-align: center;
        background-color: #5224F6;
        color: #fff;
        padding: 10px 25px;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease-in-out;
        max-width: 50%;
        cursor: pointer;
      }

      .btn-upload:hover {
        background-color: #4A1ED0;
        cursor: pointer;
      }

      /* Table Start */
      table {
          width: 100%;
          border-collapse: collapse;
      }

      th, td {
          padding: 10px;
          text-align: left;
          border-bottom: 1px solid #ddd;
      }

      th {
          background-color: #5224F6;
          color: #fff;
      }

      tr:hover {
          background-color: #E6E6E6;
      }

      td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }

      td i {
        margin-right: 5px;
        vertical-align: middle;
      }

      .image-column {
          max-width: 150px;
      }

      .image-preview {
          max-width: 100px;
          max-height: 100px;
          cursor: pointer;
      }
      /* Table End */

      /* Media query for smaller screens */
      @media (max-width: 768px) {
          table {
              font-size: 14px;
              overflow-x: auto;
          }
          th, td {
              padding: 5px;
          }
          .image-column {
              max-width: 80px;
          }
          .image-preview {
              max-width: 60px;
              max-height: 60px;
          }

          td i {
              margin-right: 5px;
              vertical-align: middle;
          }
          td a {
              display: inline-block;
              max-width: 100%;
              white-space: nowrap;
              overflow: hidden;
              text-overflow: ellipsis;
          }
      }

      .modal {
          display: none;
          position: fixed;
          z-index: 1;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto;
          background-color: rgba(0, 0, 0, 0.9);
      }

      .centered-image {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        max-height: 100%;
      }

      .modal-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
      }

      .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        font-weight: bold;
        color: #fff;
        cursor: pointer;
      }

      .close:hover {
        color: #bbb;
      }

      p.vi {
        font-style: normal;
        font-weight: bold;
      }

      .version-info {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        padding: 10px;
      }

      .container {
          max-width: 1000px;
          margin: 20px auto;
          padding: 20px;
          background-color: #fff;
          border: 1px solid #dcdcdc;
          border-radius: 5px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .ml {
        cursor: pointer;
      }

      .fa-arrow-up-from-bracket {
        margin-right: 10px;
      }

      .table-lr {
        border-top-left-radius: 5px;
      }

      .table-rr {
        border-top-right-radius: 5px;
      }
    </style>
</head>
<body>
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-xmark"></i></a>
    <a href="./">Home</a>
    <a href="./FF-config/settings.php">Settings</a>
    <a href="./FF-config/update.php">Update</a>
    <a href="#">Help</a>
  </div>

  <header>
    <span class="ml" onclick="openNav()"><i class="fa-solid fa-bars"></i></span>
    <h1>Fileflow Directory</h1>
  </header>


  <div id="main">
    <div class="container">

    <div style="margin: 10px auto; padding-top: 10px; padding-bottom: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; margin-bottom: 10px;">
        <div style="display: flex; align-items: center;">
          <h4>Index of <span class="dir">/htdocs<?php echo $currentPath; ?></span></h4>
        </div>
        <div style="display: flex; align-items: center;">
          <div class="upload">
              <label for="file-upload" class="btn-upload"><i class="fa-solid fa-arrow-up-from-bracket"></i> Upload</label>
              <input type="file" id="file-upload" style="display: none;" multiple>
          </div>
        </div>
      </div>


    <div style="margin: 20px auto; padding-top: 20px; padding-bottom: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; margin-bottom: 10px;">
        <div style="display: flex; align-items: center;">
            <label for="search-input" style="margin-right: 10px;"></label>
            <input type="text" id="search-input" style="padding: 5px; font-size: 16px; width: 250px; border: 1px solid #ccc; border-radius: 5px;" placeholder="Enter search query">
        </div>
        <div style="display: flex; align-items: center;">
            <label for="sort-select" style="margin-right: 10px;">Sort by:</label>
            <select id="sort-select" style="padding: 5px;">
                <option value="0">Name</option>
                <option value="1">Last Modified</option>
                <option value="2">Size</option>
            </select>
        </div>
    </div>
  </div>

  <table>
      <tr>
          <th class="table-lr">Name</th>
          <th>Last Modified</th>
          <th>Size</th>
          <th class="table-rr">Preview</th>
      </tr>
      <?php
      // Function to format file size dynamically
      function formatFileSize($sizeInBytes) {
          $units = ['B', 'KB', 'MB', 'GB', 'TB'];
          $i = 0;
          while ($sizeInBytes >= 1024 && $i < count($units) - 1) {
              $sizeInBytes /= 1024;
              $i++;
          }
          return round($sizeInBytes, 2) . ' ' . $units[$i];
      }

      // Function to check if a file has an image extension
      function isImage($extension) {
          $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'ico', 'tiff', 'apng', 'webp'];
          return in_array($extension, $imageExtensions);
      }

      // Check if the directory exists
      if (is_dir($htdocsPath)) {
          $items = scandir($htdocsPath);
          foreach ($items as $item) {
              if ($item != '.' && $item != '..') {
                  $itemPath = urlencode($item);

                  // Determine if it's a directory or a file
                  $isDirectory = is_dir($htdocsPath . '/' . $item);
                  $extension = strtolower(pathinfo($item, PATHINFO_EXTENSION));

                  // Different icon classes based on file type
                  if ($isDirectory) {
                      $iconClass = 'folder-icon fas fa-folder';
                  } elseif (in_array($extension, ['css', 'js'])) {
                      $iconClass = 'fa-regular fa-file-code'; // Icon class for CSS and JavaScript files
                  } elseif (isImage($extension)) {
                      $iconClass = 'fa-regular fa-file-image'; // Icon class for image files
                  } elseif (in_array($extension, ['txt'])) {
                      $iconClass = 'fa-regular fa-file-text'; // Icon class for text files
                  } elseif (in_array($extension, ['html', 'htm'])) {
                      $iconClass = 'fa-regular fa-file-code'; // Icon class for HTML files
                  } elseif (in_array($extension, ['php'])) {
                      $iconClass = 'fa-regular fa-file-code'; // Icon class for PHP files
                  } elseif (in_array($extension, ['md'])) {
                      $iconClass = 'fa-brands fa-markdown'; // Icon class for MD files
                  } elseif (in_array($extension, ['json'])) {
                      $iconClass = 'fa-regular fa-file-code'; // Icon class for JSON files
                  } elseif (in_array($extension, ['vue'])) {
                      $iconClass = 'fa-brands fa-vuejs'; // Icon class for Vue files
                  } elseif (in_array($extension, ['jsx'])) {
                      $iconClass = 'fa-brands fa-react'; // Icon class for React files
                  } elseif (in_array($extension, ['swift'])) {
                      $iconClass = 'fa-brands fa-swift'; // Icon class for Swift
                  } elseif (in_array($extension, ['go'])) {
                      $iconClass = 'fa-brands fa-golang'; // Icon class for Go
                  } elseif (in_array($extension, ['rs'])) {
                      $iconClass = 'fa-brands fa-rust'; // Icon class for Rust
                  } elseif (in_array($extension, ['py'])) {
                      $iconClass = 'fa-brands fa-python'; // Icon class for Python
                  } elseif (in_array($extension, ['gitignore', 'gitattributes'])) {
                      $iconClass = 'fa-brands fa-git'; // Icon class for Git
                  } elseif (in_array($extension, ['csv'])) {
                      $iconClass = 'fa-solid fa-file-csv'; // Icon class for CSV
                  } elseif (in_array($extension, ['pdf'])) {
                      $iconClass = 'fa-regular fa-file-pdf'; // Icon class for PDF
                  } elseif (in_array($extension, ['xlsx', 'xls'])) {
                      $iconClass = 'fa-regular fa-file-excel'; // Icon class for Excel
                  } elseif (in_array($extension, ['docx', 'doc'])) {
                      $iconClass = 'fa-regular fa-file-word'; // Icon class for Word
                  } elseif (in_array($extension, ['zip', 'tar', 'rar', 'tar', 'tar.gz', '7z'])) {
                      $iconClass = 'fa-regular fa-file-zipper'; // Icon class for Zip
                  } elseif (in_array($extension, ['Dockerfile', 'dockerignore'])) {
                      $iconClass = 'fra-brands fa-docker'; // Icon class for Docker
                  } elseif (in_array($extension, ['mp3', 'aac', 'wav', 'aiff', 'aa', 'alac', 'flac', 'm4a', 'm4b', 'm4p', 'mpc', 'wma', 'webm'])) {
                      $iconClass = 'fa-regular fa-file-audio'; // Icon class for audio files
                  } else {
                      $iconClass = 'fa-regular fa-file';
                  }

                  $itemType = $isDirectory ? 'Directory' : 'File';

                  // Fetching actual data
                  $lastModified = date("d-m-Y H:i:s", filemtime($htdocsPath . '/' . $item));
                  $fileSizeInBytes = filesize($htdocsPath . '/' . $item);
                  $size = $isDirectory ? '-' : formatFileSize($fileSizeInBytes);

                  // Display an image preview if it's an image file
                  if (isImage($extension)) {
                      echo '<tr class="search-item">';
                      echo '<td><i class="' . $iconClass . '"></i><a href="' . $itemPath . '">' . $item . '</a></td>';
                      echo '<td>' . $lastModified . '</td>';
                      echo '<td>' . $size . '</td>';
                      // New column for image preview
                      echo '<td class="image-column"><img class="image-preview" src="' . $itemPath . '" alt="' . $item . '"></td>';
                      echo '</tr>';
                  } else {
                      // Display other file types
                      echo '<tr class="search-item">';
                      echo '<td><i class="' . $iconClass . '"></i><a href="' . $itemPath . '">' . $item . '</a></td>';
                      echo '<td>' . $lastModified . '</td>';
                      echo '<td>' . $size . '</td>';
                      // Empty column for non-image files
                      echo '<td></td>';
                      echo '</tr>';
                  }
              }
          }
      } else {
          echo '<p style="color: red;font-weight: bold;text-align: center;padding: 20px;">You do not currently have any contents within this directory.</p>';
      }
      ?>

  </table>
</div>
</div>

<div class="container server-info">
  <p><strong>Server Information:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?>. Server at localhost Port <?php echo $_SERVER['SERVER_PORT']; ?></p>
</div>

<div id="imageModal" class="modal">
  <span class="close" id="closeModal">&times;</span>
  <div class="modal-content">
    <img id="modalImage" class="centered-image" src="">
  </div>
</div>

<!-- File Upload PHP -->
<?php
if (isset($_FILES["fileToUpload"]) && isset($_POST['currentDirectory'])) {
    $currentDirectory = $_POST['currentDirectory']; // Directory where the user wants to upload the file
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . $currentDirectory . '/'; // Full path to the user's directory
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded to " . $currentDirectory;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['userfile'])) {
        $uploadDirectory = './';  // Current directory, change this as needed

        // Iterate through each uploaded file
        foreach ($_FILES['userfile']['tmp_name'] as $key => $tmp_name) {
            $uploadFile = $uploadDirectory . basename($_FILES['userfile']['name'][$key]);

            // Move the uploaded file to the current directory
            if (move_uploaded_file($tmp_name, $uploadFile)) {
                // File uploaded successfully, you can add any additional logic here
            } else {
                // Error handling for failed upload
            }
        }
    }
}
?>
<!-- File Upload PHP -->

  <script src="https://kit.fontawesome.com/365667f62b.js" crossorigin="anonymous"></script>

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    // Open Image Feature
    var modal = document.getElementById("imageModal");
    var modalImage = document.getElementById("modalImage");
    var closeModal = document.getElementById("closeModal");

    function openModal(imageSrc) {
        modalImage.src = imageSrc;
        modal.style.display = "block";
    }

    function closeModalFunction() {
        modal.style.display = "none";
    }

    closeModal.addEventListener("click", closeModalFunction);

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            closeModalFunction();
        }
    });

    var imagePreviews = document.querySelectorAll(".image-preview");
    imagePreviews.forEach(function(imagePreview) {
        imagePreview.addEventListener("click", function() {
            openModal(imagePreview.src);
        });
    });

  // Sort by Feature
  function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.querySelector("table");
    switching = true;

    var sortColumn = parseInt(document.getElementById("sort-select").value);

    while (switching) {
      switching = false;
      rows = table.rows;

      for (i = 1; i < rows.length - 1; i++) {
        shouldSwitch = false;

        x = rows[i].getElementsByTagName("td")[sortColumn];
        y = rows[i + 1].getElementsByTagName("td")[sortColumn];

        if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }

      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  }

  document.getElementById("sort-select").onchange = sortTable;

  sortTable();


// Search Function
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchItems = document.querySelectorAll('.search-item');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        searchItems.forEach(function (item) {
            const text = item.textContent.toLowerCase();
            if (text.includes(query)) {
                item.style.display = 'table-row';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('focus', function() {
        this.style.outline = '3px solid #e0e0e0';
    });

    searchInput.addEventListener('blur', function() {
        this.style.outline = 'none';
    });

// Update checker
const username = 'TheR0cketMan';
const repository = 'Fileflow';

function checkForUpdates() {
  // Fetch the GitHub releases
fetch(`https://api.github.com/repos/${username}/${repository}/releases`)
  .then((response) => response.json())
  .then((releases) => {
    if (releases.length > 0) {
      const latestRelease = releases[0];
      const latestVersion = latestRelease.tag_name;
      const currentVersion = '1.0-alpha-2';

      // Compare versions and show/hide the update link
      const updateLink = document.getElementById('updateLink');
      if (latestVersion !== currentVersion) {
        // Show the update link if there's an update
        updateLink.style.display = 'block';
      } else {
        // Hide the update link if there's no update
        updateLink.style.display = 'none';
      }
    }
  })
  .catch((error) => {
    console.error('Error checking for updates:', error);
  });

}

window.addEventListener('load', checkForUpdates);

// File Upload
const fileUploadInput = document.getElementById('file-upload');

    fileUploadInput.addEventListener('change', (event) => {
        const files = event.target.files;
        const formData = new FormData();

        for (let i = 0; i < files.length; i++) {
            formData.append('userfile[]', files[i]);
        }

        // Send a POST request to the same PHP file (index.php) to handle file uploads
        fetch('index.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response, such as displaying a success message or updating the file list.
        })
        .catch(error => {
            console.error('File upload failed:', error);
        });
    });
  </script>
</body>
</html>
