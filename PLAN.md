
## 1. IMPROVEMENTS
- [ ] **PDF Generation**
  - Improve pdf generation pass all things involving pdf generation to PdfController
  - Add automatic selection of client data if available or ask user for data (Modal) 
  - Implement title ref modification
  - store pdf in database or in storage
  - Implement pdf download functionality
  - Implement pdf signing functionality
- [ ] **Sample Analysis**
  - when a report is created it should be displayed in the sample analysis page
  - change the date format to dd/mm/yy & automatically select the today date & now time 
  - Identify the fields that could be autocompleted using previous data
- [ ] **DATABASE**
  - Create a table alias for spiceis column ex : "Cabillaud" -> "kbio"
  - When Creating an analysis all the fields that are suited to be repeated like "spicies" should be stored in a different table ex: "spicies" for autocompletion (the table could be in json and have unique values) 

  - Implement API versioning
- [ ] **Code Standards**
  - Implement PHP_CodeSniffer with PSR-12
  - Set up PHP CS Fixer
  - Add PHPStan for static analysis