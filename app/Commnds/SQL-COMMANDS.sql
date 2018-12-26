-- SQL COMMANDS

-- *********** SELECTS ****************

-- Cards
SELECT [Site]
      ,[Family Number]
      ,[Card Number]
      ,[Status]
	  ,[UserID]
      ,[Start Date]
      ,[End Date]     
      ,[Card_ID]     
      ,[CardNumHex]
FROM [Centaur3Main].[dbo].[Cards]

--Users
SELECT [UserID]
      ,[SiteID]
      ,[FirstName]
      ,[LastName]
      ,[Status]
      ,[StartDate]
      ,[EndDate]      
      ,[UserGroupID]
FROM [Centaur3Main].[dbo].[Users]

---------------------------------------------



-- DELETE IN RAGE
-- Koga se brishe karticka / se brishe i user - ima procedura vo Databazata
DELETE FROM Cards
WHERE UserID IN  (68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 431)