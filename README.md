# HealthCareMining 
The main objective of this project is to develop a informative website that converts the unstructured data from user written **COVID-19** related posts that were scraped from various forums like ( [MedHelp.com](https://www.medhelp.org/forums/Coronavirus/show/2203), [Patient.info](https://patient.info/coronavirus-covid-19), [Mayoclinic.org](https://www.mayoclinic.org/) ) into properly structured data and developing a parameter based search interface to provide the relevant posts, symptoms and treatments (if any) based on the user's search.
### Assumptions
The majority of the user written posts
```
➔ Will not contain any non-contextual information.
```
```
➔ The information described by the user is COVID-19 related.
```
### Web Scraping
**Aim:** to scrape and extract COVID-19 related data from mulitple forums.
**Forums from which the data is scraped**
* MedHelp
* Patient.info
* Mayoclinic.org
* Livescience.com
* Camh.ca
We have used python's scrapy framework for web scraping.

### MetaMap
➔ Built by National Library of Medicine (NLM).\
➔ Highly configurable.\
➔ It used computational-linguistic and Natural Language Processing techniques.\
➔ Java Web API and Online Interactive Interface available.

### SympGraph
* A graph with symptoms as nodes and co-occurence relations between these symptoms as edges.
* The symptoms from various posts/forums written by different patients are used to generate this graph.
* It is used for symptom expansion.

### References
* Bello, Fernando López, et al. "From medical records to research papers: a literature analysis pipeline for supporting medical genomic diagnosis processes." Informatics in Medicine Unlocked 15 (2019): 100181. 
* https://www.medhelp.org/forums/Coronavirus/show /2203
* A. Aronson. MetaMap - A Tool For Recognizing UMLS Concepts in Text. 2018. https://metamap.nlm.nih.goV
* López-Ubeda, Pilar, et al. "Filtering and reranking using MetaMap named entities recognizer." TREC. 2018.
* Sondhi, Parikshit, et al. "SympGraph: a framework for mining clinical notes through symptom relation graphs." Proceedings of the 18th ACM SIGKDD international conference on Knowledge discovery and data mining. 2012.
* F. Wang. Healthcare Data Mining with Matrix Models. https:// astro.temple.edu/ tua87106/KDD16_tut_part1.pdf

