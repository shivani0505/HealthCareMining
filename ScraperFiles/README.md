# Scraping Using SCRAPY
* We have using scrapy tool to scrape the data from 5 websites which includes medhelp, mayoclinic, patientsinfo, live science, camhx.
* Data structure followed for scraping:
  Discussion{
    url: (String)
    title(String),
    author(String),
    content(String),
    replies([Reply])
    }

  Reply{
    content(String),
    sub_replies([String])
  }
