# Scraping Using SCRAPY
* We have using scrapy tool to scrape the data from 5 websites which includes medhelp, mayoclinic, patientsinfo, live science, camhx.
* Data structure followed for scraping:
  Discussion{
    <br>url: (String)
    <br>title(String),
    <br>author(String),
    <br>content(String),
    <br>replies([Reply])
    <br>}
  <br>
  <br>Reply{
    <br>content(String),
    <br>sub_replies([String])
  <br>}
