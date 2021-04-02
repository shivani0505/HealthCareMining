import os
import csv
import json
import pandas


files = [f for f in os.listdir('.') if os.path.isfile(f) and ("cahmx.csv" in f or "livescience.csv" in f or "mayo.csv" in f or "medhelp.csv" in f or "patientinfo.csv" in f)]


with open('/Users/shivanipriya/Documents/GitHub/HealthCareMining/ScraperFiles/stage1_scrapping.json') as scraper_file:
	scraper_data = json.load(scraper_file)

new_df = pandas.DataFrame(columns =["url","Title","Author","Total_Replies","Total_Weight"])

replies_weight = 50
date_weight = 50

for file in files:
	print(file)
	df = pandas.read_csv(file)

	for item in df.itertuples():
		PostNum = item.PostNumber
		link = item.PostLink
		for keyValue in scraper_data:
			if (keyValue["url"] == link):
				no_of_replies = 0
				replies_index = 0
				subreplies_count = 0
				Total_Weight = 0
				Total_Replies = 0
				

				Title = keyValue["title"]
				Author = keyValue["author"]
				replies = keyValue["replies"]
				no_of_replies = len(replies)
				
				while replies_index<no_of_replies:
					subreplies = replies[i]['sub_replies']
					replies_index = replies_index + 1
					if '' not in subreplies:
						subreplies_count = subreplies_count + 1
				#Total_Replies is the summation of number of replies and sub_replies on a post.
				#Higher number denotes more user engaging in the post.
				Total_Replies = subreplies_count + length
				#Total_Weight determines the rank of the post in the search result.
				#Higher weight is shown above in the search result list.
				if(Total_Replies != 0):
					Total_Weight = (replies_weight * Total_Replies) + (date_weight / PostNum)
				else :
					Total_Weight = date_weight / PostNum
				new_df.loc[len(new_df.index)] = [link,Title,Author,Total_Replies,Total_Weight] 

	df3 = pandas.concat([df, new_df], axis=1)
	df3 = df3.drop(["url"],axis =1)
	filename ="updated_" + file
	df3.to_csv(filename,index=False)
