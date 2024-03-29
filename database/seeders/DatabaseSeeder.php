<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'developer',
        //     'email' => 'mada.baskoro@id.panasonic.com',
        //     'nik' => 'developer',
        //     'department' => '1',
        //     'password' => bcrypt('developer123'),
        //     'role' => 'developer',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'nik' => 'admin',
        //     'department' => '1',
        //     'password' => bcrypt('admin123'),
        //     'role' => 'admin',
        // ]);
        DB::table('easter')->insert([
        ["text" => "Did you know the Internet was originally called ARPANet (Advanced Research Projects Agency Network) designed by the US department of defense"],
        ["text" => "Did you know there are only 4 words in the English language which end in 'dous' (they are: hazardous, horrendous, stupendous and tremendous)"],
        ["text" => "Did you know ice skating rinks always go counter clock wise (for the majority of people that are right handed needing to hang onto the rail)"],
        ["text" => "Did you know the world's knowledge is growing so fast that 90% of what we will know in 50 years time will be discovered in those 50 years"],
        ["text" => "Did you know 'Bookkeeper' and 'bookkeeping' are the only 2 words in the English language with three consecutive double letters"],
        ["text" => "Did you know the word 'uncopyrightable' is the is the only 15 letter word that can be spelled without repeating any letter"],
        ["text" => "Did you know there is enough petrol in a full tank of a Jumbo Jet to drive the average car 4 times around the world"],
        ["text" => "Did you know that you burn more calories eating celery than it contains (the more you eat the thinner you become)"],
        ["text" => "Did you know the sentence 'the quick brown fox jumps over the lazy dog' uses every letter in the English alphabet"],
        ["text" => "Did you know the Australian aircraft carrier QANTAS stands for Queensland And Northern Territories Aerial Service"],
        ["text" => "Did you know the longest street in the world is Yonge street in Toronto Canada measuring 1,896 km (1,178 miles)"],
        ["text" => "Did you know frogs don't usually swallow water (they absorb most of the moisture they need through their skin)"],
        ["text" => "Did you know if you filled a matchbox with gold it could be flattened into a sheet the size of a tennis court"],
        ["text" => "Did you know the word typewriter is the longest word that can be typed using only the top row of a keyboard"],
        ["text" => "Did you know the movie Pulp Fiction cost $8 million to make with $5 million going towards actor's salaries"],
        ["text" => "Did you know when lightning strikes it can reach up to 30,000 degrees celsius (54,000 degrees fahrenheit)"],
        ["text" => "Did you know crocodiles are responsible for over a 1,000 deaths each year by the Banks of the Nile river"],
        ["text" => "Did you know Halley's comet passes the Earth every 76 years (the next time it will return will be 2062)"],
        ["text" => "Did you know the stomach acids found in a snakes stomach can digest bones and teeth but not fur or hair"],
        ["text" => "Did you know the word 'testify' derived from a time when men were required to swear on their testicles"],
        ["text" => "Did you know the average soccer ball is made up of 32 leather panels and held together by 642 stitches"],
        ["text" => "Did you know if you add up all the numbers from 1 to 100 consecutively (1 + 2 + 3...) it totals 5050"],
        ["text" => "Did you know the hyoid bone in your throat is the only bone in your body not attached to any other"],
        ["text" => "Did you know the word 'Strengths' is the longest word in the English language with just one vowel"],
        ["text" => "Did you know the word laser stands for 'Light Amplification by Stimulated Emission of Radiation'"],
        ["text" => "Did you know the word 'underground is the only word that begins and ends with the letters 'und'"],
        ["text" => "Did you know the Chinese used fingerprints as a method of identification as far back as AD 700"],
        ["text" => "Did you know that the first MTV video played was 'Video killed the radio star' by the Buggles"],
        ["text" => "Did you know over 2,500 left handed people are killed a year from using right handed products"],
        ["text" => "Did you know not all your taste buds are on our tongue (10% are on the insides of you cheeks)"],
        ["text" => "Did you know a car travelling at 80kph (50mph) uses half its fuel to overcome wind resistance"],
        ["text" => "Did you know the meaning of 'Blue Chip' comes from blue casino chips which have a high value"],
        ["text" => "Did you know a cat uses its whiskers to determine if a space is too small to squeeze through"],
        ["text" => "Did you know the word old English word 'juke' meaning dancing lends its name to the juke box"],
        ["text" => "Did you know the hydrochloric acid found in your stomach is strong enough to dissolve a nail"],
        ["text" => "Did you know you're more likely to be killed by a champagne cork than by a poisonous spider"],
        ["text" => "Did you know all the blinking in one day equates to having your eyes closed for 30 minutes"],
        ["text" => "Did you know a humming bird flaps its wings up to 90 times a second (5,400 times a minute)"],
        ["text" => "Did you know Switzerland eats the most chocolate equating to 10 kilos per person per year"],
        ["text" => "Did you know the yo-yo was originally used as a weapon for hunting the in the Philippines"],
        ["text" => "Did you know the coins thrown into the Trevi fountain in Italy are collected for charity"],
        ["text" => "Did you know 42% of men and women 25% don't wash their hands after using a public toilet"],
        ["text" => "Did you know DVDs are physically the same size as a CDs but can store 13 times more data"],
        ["text" => "Did you know in a deck of cards the king of hearts is the only king without a moustache"],
        ["text" => "Did you know it takes 50 minutes to soft boil and two hours to hard boil an ostrich egg"],
        ["text" => "Did you know M&M's chocolate stands for the initials for its inventors Mars and Murrie"],
        ["text" => "Did you know to crack a whip the tip must be travelling faster than the speed of sound"],
        ["text" => "Did you know according to the old English time system a moment is 1 and a half minutes"],
        ["text" => "Did you know the water in the Dead Sea is so salty that its easier to float than sink"],
        ["text" => "Did you know your most sensitive finger is your index finger (closest to your thumb)"],
        ["text" => "Did you know a lobsters blood is colorless but when exposed to oxygen it turns blue"],
        ["text" => "Did you know stewardesses is the longest word that is typed with only the left hand"],
        ["text" => "Did you know hippopotamuses have killed more people in Africa than any other animal"],
        ["text" => "Did you know the official bird of Redondo Beach, California, is the Goodyear Blimp?"],
        ["text" => "Did you know Brazil borders every country in South America except Chile and Ecuador"],
        ["text" => "Did you know wine is sold in tinted bottles because it spoils when exposed to light"],
        ["text" => "Did you know it takes 1 alligator to make a pair of shoes and 3 for a pair of boots"],
        ["text" => "Did you know there is 200 times more gold in the world's oceans than has been mined"],
        ["text" => "Did you know apples are more effective at waking you up in the morning than coffee"],
        ["text" => "Did you know the naming of tropical storms and hurricanes officially began in 1953"],
        ["text" => "Did you know India has the most post offices than any other country (over 100,000)"],
        ["text" => "Did you know Brazil got its name from the Brazilian nut (not the other way around)"],
        ["text" => "Did you know the first letters of the months July through to November spell JASON"],
        ["text" => "Did you know The Great Wall of China is approximately 6,430 Km long (3,995 miles)"],
        ["text" => "Did you know if your DNA was stretched out it would reach to the moon 6,000 times"],
        ["text" => "Did you know when recognising a persons face you use the right side of your brain"],
        ["text" => "Did you know there are more insects in the world than all other animals combined"],
        ["text" => "Did you know 2 million hydrogen atoms would be required to cover a full stop (.)"],
        ["text" => "Did you know oxygen, carbon, hydrogen and nitrogen make up 90% of the human body"],
        ["text" => "Did you know the most commonly forgotten item for travelers is their toothbrush"],
        ["text" => "Did you know “Q” is the only letter that doesn't appear in any U.S. state name?"],
        ["text" => "Did you know every single possible 3 character .com domain has been registered"],
        ["text" => "Did you know there are 70 million sheep in New Zealand (with 4 million people)"],
        ["text" => "Did you know  40 percent of human jobs could be replaced by AI in the future?"],
        ["text" => "Did you know months that start on a Sunday will always have a Friday the 13th"],
        ["text" => "Did you know the US flag has 13 stripes (representing the original 13 states)"],
        ["text" => "Did you know after Hawaii, New York is the state surrounded by the most water"],
        ["text" => "Did you know the subject of the first printed book in England was about chess"],
        ["text" => "Did you know all of the clocks in the movie 'Pulp Fiction' are fixed to 4:20"],
        ["text" => "Did you know the worlds smallest bird is the 'bee hummingbird' found in Cuba"],
        ["text" => "Did you know it would cost $18.3 million to make a replica Darth Vader suit?"],
        ["text" => "Did you know Meghan Markle and Prince Harry are incredibly distant cousins?"],
        ["text" => "Did you know Icelandic phone books are listed by first names (not surnames)"],
        ["text" => "Did you know the human body contains 96,000km(59,650miles) of blood vessels"],
        ["text" => "Did you know 'Lonely Planet' for travelers is based in Melbourne Australia"],
        ["text" => "Did you know in 1878 the first telephone book made contained only 50 names"],
        ["text" => "Did you know  Queen Elizabeth II keeps track of when she wore each outfit?"],
        ["text" => "Did you know the Amazon rainforest produces half the world's oxygen supply"],
        ["text" => "Did you know more people die from falling coconuts then from shark attacks"],
        ["text" => "Did you know tarantula spiders can survive 2 and a half years without food"],
        ["text" => "Did you know that after petrol, coffee is the largest item bought and sold"],
        ["text" => "Did you know Sir Isaac Newton was 23 when he discovered the law of gravity"],
        ["text" => "Did you know room temperature is defined as between 20 to 25C (68 to 77F)"],
        ["text" => "Did you know the Earth is struck by lightning over 100 times every second"],
        ["text" => "Did you know armadillos have 4 babies at a time and are all the same sex"],
        ["text" => "Did you know the most common mental illnesses are anxiety and depression"],
        ["text" => "Did you know giraffes and rats can last longer without water than camels"],
        ["text" => "Did you know you begin to feel thirsty when your body losses 1% of water"],
        ["text" => "Did you know the D.C. in Washington D.C. stands for District of Columbia"],
        ["text" => "Did you know the smallest bones in the human body are found in your ear"],
        ["text" => "Did you know each time you see a full moon you always see the same side"],
        ["text" => "Did you know a hummingbird's heart beats at over a 1,000 times a minute"],
        ["text" => "Did you know black on yellow are the 2 colors with the strongest impact"],
        ["text" => "Did you know the brand Nokia is named after a place in Southern Finland"],
        ["text" => "Did you know wind doesn't make a sound until it blows against an object"],
        ["text" => "Did you know Oak trees don't produce acorns until they are 50 years old"],
        ["text" => "Did you know the word 'almost' is the longest word spelt alphabetically"],
        ["text" => "Did you know EMI awards stands for 'Electrical and Musical Instruments'"],
        ["text" => "Did you know the first Burger King was opened in Florida Miami in 1954"],
        ["text" => "Did you know more people are allergic to cows milk than any other food"],
        ["text" => "Did you know the first train reached a top speed of only 8 kmh (5 mph)"],
        ["text" => "Did you know the most common injury in ten pin bowling is a sore thumb"],
        ["text" => "Did you know the only continent with no active volcanoes is Australia"],
        ["text" => "Did you know African Grey Parrots have vocabularies of over 200 words"],
        ["text" => "Did you know its physically impossible for pigs to look up at the sky"],
        ["text" => "Did you know rice is the staple food for 50% of the worlds population"],
        ["text" => "Did you know you burn more calories sleeping than watching television"],
        ["text" => "Did you know sound travels 4.3 times faster through water than in air"],
        ["text" => "Did you know the longest recorded flight of a chicken was 13 seconds"],
        ["text" => "Did you know the Grand Canyon can hold around 900 trillion footballs"],
        ["text" => "Did you know an elephants ears are used to regulate body temperature"],
        ["text" => "Did you know your skin is the largest organ making up the human body"],
        ["text" => "Did you know the human body of a 70 kg person contains 0.2mg of gold"],
        ["text" => "Did you know a hard boiled eggs spin (uncooked or soft boiled don't)"],
        ["text" => "Did you know Bill Gates began programming computers at the of age 13"],
        ["text" => "Did you know the longest possible eclipse of the sun is 7.31 minutes"],
        ["text" => "Did you know plastic bottles were first used for soft drinks in 1970"],
        ["text" => "Did you know more than 75% of all countries are north of the equator"],
        ["text" => "Did you know money is the number one thing that couples argue about"],
        ["text" => "Did you know In eastern Africa you can buy beer brewed from bananas"],
        ["text" => "Did you know lions are identifiable through their whisker patterns?"],
        ["text" => "Did you know that you can spell the word 'level' the same backwards"],
        ["text" => "Did you know the word racecar can be spelled the same way backwards"],
        ["text" => "Did you know Iceland consumes more Coca Cola than any other country"],
        ["text" => "Did you know that in developed countries 27% of food is thrown away"],
        ["text" => "Did you know the odds of being struck by lightning are 600,000 to 1"],
        ["text" => "Did you know minus 40C is exactly the same temperature as minus 40F"],
        ["text" => "Did you know hummingbirds are the only bird that can fly backwards"],
        ["text" => "Did you know your body loses up to 8 percent of water on a flight?"],
        ["text" => "Did you know the longest breath held underwater is 24:03 minutes? "],
        ["text" => "Did you know the past tense for the English word 'dare' is 'durst'"],
        ["text" => "Did you know the Taj Mahal in India is made entirely out of marble"],
        ["text" => "Did you know the life span of a house fly is between 10 to 25 days"],
        ["text" => "Did you know 1 square inch of human skin contains 625 sweat glands"],
        ["text" => "Did you know goldfish can see both infrared and ultraviolet light"],
        ["text" => "Did you know a giraffe can clean its ears with its 21 inch tongue"],
        ["text" => "Did you know lightning strikes the Earth 6,000 times every minute"],
        ["text" => "Did you know your tongue is the fastest healing part of your body"],
        ["text" => "Did you know 1 billion snails are served in restaurants each year"],
        ["text" => "Did you know Niagara Falls could fill 4,000 bathtubs every second"],
        ["text" => "Did you know unless food is mixed with saliva you can't taste it"],
        ["text" => "Did you know on your birthday you share it with 9 million others"],
        ["text" => "Did you know Monopoly is the most played board game in the world"],
        ["text" => "Did you know the film 'Mary Poppins' was filmed entirely indoors"],
        ["text" => "Did you know the dot on top of the letter 'i' is called a tittle"],
        ["text" => "Did you know a piece of paper cannot be folded more than 7 times"],
        ["text" => "Did you know there are 7 points on the Statue of Liberty's crown"],
        ["text" => "Did you know a chameleons tongue is twice the length of its body"],
        ["text" => "Did you know an elephant's trunk can hold over 5 litres of water"],
        ["text" => "Did you know the most commonly used letter in the alphabet is E"],
        ["text" => "Did you know it's possible to lead a cow up stairs but not down"],
        ["text" => "Did you know Madonna and Michael Jackson were both born in 1958"],
        ["text" => "Did you know 111,111,111 x 111,111,111 = 12,345,678,987,654,321"],
        ["text" => "Did you know a giraffe can go longer without water than a camel"],
        ["text" => "Did you know the average bed contains over 6 billion dust mites"],
        ["text" => "Did you know men are stuck by lightning 7 times more than women"],
        ["text" => "Did you know your brain uses 25% of all the oxygen your breathe"],
        ["text" => "Did you know when your face blushes so does your stomach lining"],
        ["text" => "Did you know cars were first started with ignition keys in 1949"],
        ["text" => "Did you know honey is the only natural food which never spoils"],
        ["text" => "Did you know the average human brain contains around 78% water"],
        ["text" => "Did you know Coca Cola launched its 3rd product Sprite in 1961"],
        ["text" => "Did you know the oldest word in the English language is 'town'"],
        ["text" => "Did you know grapes explode when you put them in the microwave"],
        ["text" => "Did you know the movie 'Wayne's World' was filmed in two weeks"],
        ["text" => "Did you know Brazil covers 50% of the South American continent"],
        ["text" => "Did you know small dogs usually live longer than larger breeds"],
        ["text" => "Did you know Hawaii was originally called the Sandwich Islands"],
        ["text" => "Did you know Americas top selling ice cream flavour is vanilla"],
        ["text" => "Did you know crocodiles swallow rocks to help them dive deeper"],
        ["text" => "Did you know the fortune cookie was invented in San Francisco"],
        ["text" => "Did you know 1 nautical knot equates to 1.852 Kph (1.150 mph)"],
        ["text" => "Did you know elephants sleep between 4 - 5 hours in 24 period"],
        ["text" => "Did you know you burn more calories sleeping than watching TV"],
        ["text" => "Did you know there are 22 stars in the Paramount studios logo"],
        ["text" => "Did you know a bowling pin will fall at a tilt of 7.5 degrees"],
        ["text" => "Did you know Americans throw away 44 million newspapers a day"],
        ["text" => "Did you know the coloured part of your eye is called the iris"],
        ["text" => "Did you know The first English dictionary was written in 1755"],
        ["text" => "Did you know a full moon is 9 times brighter than a half moon"],
        ["text" => "Did you know flys always launch backwards for a quick getaway"],
        ["text" => "Did you know Hawaii officially became apart of the US in 1900"],
        ["text" => "Did you know Ralph Lauren's original name was Ralph Lifshitz"],
        ["text" => "Did you know each insect is a host to ten bacterial species?"],
        ["text" => "Did you know rubber bands last longer when kept refrigerated"],
        ["text" => "Did you know the opposite sides of a die always adds up to 7"],
        ["text" => "Did you know the most fatal car accidents occur on Saturdays"],
        ["text" => "Did you know New York contains 920km (571miles) of shoreline"],
        ["text" => "Did you know you shed a complete layer of skin every 4 weeks"],
        ["text" => "Did you know fire usually moves faster uphill than downhill"],
        ["text" => "Did you know 1 googol is the number 1 followed by 100 zeros"],
        ["text" => "Did you know Hilton was the first international hotel chain"],
        ["text" => "Did you know an egg contains every vitamin except vitamin C"],
        ["text" => "Did you know your foot and your forearm are the same length"],
        ["text" => "Did you know Earth is the only planet not named after a god"],
        ["text" => "Did you know the Atlantic Ocean is saltier than the Pacific"],
        ["text" => "Did you know 13 people die every year from vending machines"],
        ["text" => "Did you know a shark's teeth are literally as hard as steel"],
        ["text" => "Did you know New Zealands first hospital was opened in 1843"],
        ["text" => "Did you know 'Topolino' is the name for Mickey Mouse Italy"],
        ["text" => "Did you know elephants are the only mammal that can't jump"],
        ["text" => "Did you know the Arctic Ocean is the smallest in the world"],
        ["text" => "Did you know Disneyland has an underground tunnel system?"],
        ["text" => "Did you know cats can jump up to 7 times their tail length"],
        ["text" => "Did you know ants stretch when they wake up in the morning"],
        ["text" => "Did you know Hawaii is the only US state that grows coffee"],
        ["text" => "Did you know for every human there are 200 million insects"],
        ["text" => "Did you know an iguana can stay under water for 28 minutes"],
        ["text" => "Did you know MasterCard was originally called MasterCharge"],
        ["text" => "Did you know the term 'disc jockey' was first used in 1937"],
        ["text" => "Did you know Rio de Janeiro translates to river of January"],
        ["text" => "Did you know the first metered taxi was introduced in 1907"],
        ["text" => "Did you know the average person falls asleep in 7 minutes"],
        ["text" => "Did you know an average person will spend 25 years asleep"],
        ["text" => "Did you know everyday is a holiday somewhere in the world"],
        ["text" => "Did you know cats have a peripheral vision of 285 degrees"],
        ["text" => "Did you know the electric chair was invented by a dentist"],
        ["text" => "Did you know Bali has the worlds largest variety of flora"],
        ["text" => "Did you know owls can't move their eyes from side to side"],
        ["text" => "Did you know tennis was originally played with bare hands"],
        ["text" => "Did you know the electric toothbrush was invented in 1939"],
        ["text" => "Did you know the original design of Monopoly was circular"],
        ["text" => "Did you know 56% of typing is completed by your left hand"],
        ["text" => "Did you know human thigh bones are stronger than concrete"],
        ["text" => "Did you know more people are killed from bees than snakes"],
        ["text" => "Did you know blonde beards grow faster than darker beards"],
        ["text" => "Did you know men have 10% more red blood cells than women"],
        ["text" => "Did you know August has the highest percentage of births"],
        ["text" => "Did you know lemons contain more sugar than strawberries"],
        ["text" => "Did you know Australia was originally called New Holland"],
        ["text" => "Did you know a jockey once won a race after he had died?"],
        ["text" => "Did you know the first sailing boats were built in Egypt"],
        ["text" => "Did you know your mouth produces 1 litre of saliva a day"],
        ["text" => "Did you know red blood cells are produced in bone marrow"],
        ["text" => "Did you know a duck can't walk without bobbing its head"],
        ["text" => "Did you know pop corn was invented by the Aztec Indians"],
        ["text" => "Did you know reindeer hair is hollow inside like a tube"],
        ["text" => "Did you know instrument strings were made from animals?"],
        ["text" => "Did you know 96% of candles sold are purchased by women"],
        ["text" => "Did you know white cats with blue eyes are usually deaf"],
        ["text" => "Did you know China manufacturers 70% of the worlds toys"],
        ["text" => "Did you know diamonds are the hardest natural substance"],
        ["text" => "Did you know the WD in WD-40 stands for Water Displacer"],
        ["text" => "Did you know women make up 49% of the worlds population"],
        ["text" => "Did you know the moon orbits the Earth every 27.32 days"],
        ["text" => "Did you know New York's Central Park was opened in 1876"],
        ["text" => "Did you know a Sphygmomanometer measures blood pressure"],
        ["text" => "Did you know an ostrich's eye is bigger than its brain"],
        ["text" => "Did you know about 90% of the worlds population kisses"],
        ["text" => "Did you know household dust is made of dead skin cells"],
        ["text" => "Did you know Americans eat 35,000 tons of pasta a year"],
        ["text" => "Did you know a flea can jump 350 times its body length"],
        ["text" => "Did you know dogs sweat through the pads on their feet"],
        ["text" => "Did you know you have fewer muscles than a caterpillar"],
        ["text" => "Did you know your normal body temperature is 37C (99F)"],
        ["text" => "Did you know frogs can't swallow with their eyes open"],
        ["text" => "Did you know crocodiles never outgrow their enclosure"],
        ["text" => "Did you know french fries are originally from Belgium"],
        ["text" => "Did you know Elvis didn't write 'Blue Suede Shoes'?"],
        ["text" => "Did you know ostriches don't bury their heads in sand"],
        ["text" => "Did you know the average person laughs 10 times a day"],
        ["text" => "Did you know your most active muscles are in your eye"],
        ["text" => "Did you know every day 7% of the US eats at McDonalds"],
        ["text" => "Did you know dirty snow melts quicker than clean snow"],
        ["text" => "Did you know 85% of plant life is found in the ocean"],
        ["text" => "Did you know dreamt is the only word that ends in mt"],
        ["text" => "Did you know almonds are members of the peach family"],
        ["text" => "Did you know scorpions glow under ultra violet light"],
        ["text" => "Did you know Christmas trees originated from Germany"],
        ["text" => "Did you know a honeybee's top speed is 24kph (15mph)"],
        ["text" => "Did you know tigers have striped skin as well as fur"],
        ["text" => "Did you know the average porcupine has 30,000 spikes"],
        ["text" => "Did you know The Dead Sea is actually an inland lake"],
        ["text" => "Did you know the first rugby club was formed in 1843"],
        ["text" => "Did you know draughts (checkers) is older than chess"],
        ["text" => "Did you know the revolving door was invented in 1888"],
        ["text" => "Did you know the drinking straw was invented in 1886"],
        ["text" => "Did you know Coca-Cola originally contained cocaine"],
        ["text" => "Did you know dragonflies have 6 legs but can't walk"],
        ["text" => "Did you know there are 31,557,600 seconds in a year"],
        ["text" => "Did you know Venetian blinds were invented in Japan"],
        ["text" => "Did you know an astronaut was allergic to the moon?"],
        ["text" => "Did you know people rarely used to smile in photos?"],
        ["text" => "Did you know a group of owls is called a parliament"],
        ["text" => "Did you know a crocodile can't stick out its tongue"],
        ["text" => "Did you know India is home to over 200 million cows"],
        ["text" => "Did you know there are 31,536,000 seconds in a year"],
        ["text" => "Did you know a cheetahs top speed is 114kph (70mph)"],
        ["text" => "Did you know bull's can run faster uphill than down"],
        ["text" => "Did you know New York was once called New Amsterdam"],
        ["text" => "Did you know spiders are arachnids and not insects"],
        ["text" => "Did you know the croissant was invented in Austria"],
        ["text" => "Did you know sponges hold more cold water than hot"],
        ["text" => "Did you know the average golf ball has 336 dimples"],
        ["text" => "Did you know a cats urine glows under a blacklight"],
        ["text" => "Did you know you take over 23,000 breaths everyday"],
        ["text" => "Did you know the Olympic flag was designed in 1913"],
        ["text" => "Did you know the lifespan of a squirrel is 9 years"],
        ["text" => "Did you know the oldest known vegetable is the pea"],
        ["text" => "Did you know a dolphins top speed is 60kmh (37mph)"],
        ["text" => "Did you know horses have 18 more bones than humans"],
        ["text" => "Did you know the largest exporter of sugar is Cuba"],
        ["text" => "Did you know the lie detector was invented in 1921"],
        ["text" => "Did you know the Hawaiian alphabet has 13 letters"],
        ["text" => "Did you know a 1/4 of your bones are in your feet"],
        ["text" => "Did you know at birth dalmations are always white"],
        ["text" => "Did you know a group of kangaroos is called a mob"],
        ["text" => "Did you know the wheelbarrow is invented in China"],
        ["text" => "Did you know Buckingham Palace has over 600 rooms"],
        ["text" => "Did you know the Eifel Tower has 2,500,000 rivets"],
        ["text" => "Did you know the average hen lays 228 eggs a year"],
        ["text" => "Did you know 1 gigayear = 1,000,000,000,000 years"],
        ["text" => "Did you know the most sung song is happy birthday"],
        ["text" => "Did you know red light has the highest wavelength"],
        ["text" => "Did you know cats spend 66% of their life asleep"],
        ["text" => "Did you know toilets use 35% of indoor water use"],
        ["text" => "Did you know a group of rhinos is called a crash"],
        ["text" => "Did you know a group of geese is called a gaggle"],
        ["text" => "Did you know domestic cats dislike citrus scents"],
        ["text" => "Did you know instant coffee was invented in 1901"],
        ["text" => "Did you know there are more chickens than people"],
        ["text" => "Did you know hiccups usually lasts for 5 minutes"],
        ["text" => "Did you know a sharks top speed is 70kmh (44mph)"],
        ["text" => "Did you know African elephants only have 4 teeth"],
        ["text" => "Did you know the rarest type of diamond is green"],
        ["text" => "Did you know hippopotamuses are born under water"],
        ["text" => "Did you know there are no rivers in Saudi Arabia"],
        ["text" => "Did you know orienteering originated from Sweden"],
        ["text" => "Did you know paper money was first used in China"],
        ["text" => "Did you know light is electro magnetic radiation"],
        ["text" => "Did you know Perth is Australia's windiest city"],
        ["text" => "Did you know Koalas sleep around 18 hours a day"],
        ["text" => "Did you know cats can't move their jaw sideways"],
        ["text" => "Did you know a group of frogs is called an army"],
        ["text" => "Did you know tree hugging is forbidden in china"],
        ["text" => "Did you know when water freezes it expans by 9%"],
        ["text" => "Did you know Isaac Newton invented the cat door"],
        ["text" => "Did you know everyone has a unique tongue print"],
        ["text" => "Did you know bats are the only mammals that fly"],
        ["text" => "Did you know a 1 minute kiss burns 26 calories"],
        ["text" => "Did you know a crocodile can't move its tongue"],
        ["text" => "Did you know cows don't have upper front teeth"],
        ["text" => "Did you know 3 US Presidents have won Grammys?"],
        ["text" => "Did you know a group of whales is called a pod"],
        ["text" => "Did you know Germany borders 9 other countries"],
        ["text" => "Did you know Peru has more pyramids than Egypt"],
        ["text" => "Did you know the doorbell was invented in 1831"],
        ["text" => "Did you know the smallest dog is the Chihuahua"],
        ["text" => "Did you know the $ sign was introduced in 1788"],
        ["text" => "Did you know soccer is the most followed sport"],
        ["text" => "Did you know your liver has over 500 functions"],
        ["text" => "Did you know on average you blink 25,000 a day"],
        ["text" => "Did you know a cat has 32 muscles in each ear"],
        ["text" => "Did you know macadamia nuts are toxic to dogs"],
        ["text" => "Did you know there is no butter in buttermilk"],
        ["text" => "Did you know women blink twice as much as men"],
        ["text" => "Did you know VHS stands for Video Home System"],
        ["text" => "Did you know the Eiffel Tower has 1,792 steps"],
        ["text" => "Did you know the Titanic was built in Belfast"],
        ["text" => "Did you know the Eiffel Tower has 1,792 steps"],
        ["text" => "Did you know the tea bag was invented in 1908"],
        ["text" => "Did you know cats have over 100 vocal chords"],
        ["text" => "Did you know an octopus pupil is rectangular"],
        ["text" => "Did you know Einstein slept 10 hours a night"],
        ["text" => "Did you know volleyball was invented in 1895"],
        ["text" => "Did you know 8% of people have an extra rib"],
        ["text" => "Did you know Scotland has the most redheads"],
        ["text" => "Did you know bananas grow pointing upwards."],
        ["text" => "Did you know 11% of people are left handed"],
        ["text" => "Did you know birds need gravity to swallow"],
        ["text" => "Did you know the safest car color is white"],
        ["text" => "Did you know gorillas sleep 14 hours a day"],
        ["text" => "Did you know a snail can sleep for 3 years"],
        ["text" => "Did you know camels are born without humps"],
        ["text" => "Did you know grasshoppers have white blood"],
        ["text" => "Did you know the Moons diameter is 3,476km"],
        ["text" => "Did you know Elvis's middle name was Aron"],
        ["text" => "Did you know your foot has 26 bones in it"],
        ["text" => "Did you know Brazil is named after a tree"],
        ["text" => "Did you know Porsche also builds tractors"],
        ["text" => "Did you know camel's milk doesn't curdle"],
        ["text" => "Did you know paper originated from China"],
        ["text" => "Did you know only female mosquitoes bite"],
        ["text" => "Did you know your head contains 22 bones"],
        ["text" => "Did you know Tokyo was once known as Edo"],
        ["text" => "Did you know a banana contains 75% water"],
        ["text" => "Did you know crocodiles are colour blind"],
        ["text" => "Did you know whales can't swim backwards"],
        ["text" => "Did you know only female mosquitoes bite"],
        ["text" => "Did you know there is no sound in space"],
        ["text" => "Did you know emus can't walk backwards"],
        ["text" => "Did you know rain contains vitamin B12"],
        ["text" => "Did you know there's a toilet museum?"],
        ["text" => "Did you know wind on Mars is audible?"],
        ["text" => "Did you know cucumbers are 96% water."],
        ["text" => "Did you know horses sleep standing up"],
        ["text" => "Did you know a jellyfish is 95% water"],
        ["text" => "Did you know all insects have 6 legs"],
        ["text" => "Did you know Viking men wore makeup?"],
        ["text" => "Did you know hummingbirds can't walk"],
        ["text" => "Did you know trees can communicate?"],
        ["text" => "Did you know Jamaica has 120 rivers"],
        ["text" => "Did you know Pearls melt in vinegar"],
        ["text" => "Did you know carrots contain 0% fat"],
        ["text" => "Did you know rabbits like licorice"],
        ["text" => "Did you know reindeer like bananas"],
        ["text" => "Did you know a moth has no stomach"],
        ["text" => "Did you know a bear has 42 teeth"],
        ["text" => "Did you know giraffes can't swim"],
        ["text" => "Did you know gold never erodes"],
        ["text" => "Did you know gunpowder is formed by mixing charcoal, saltpetre and sulphur"],
        ["text" => "Did you know giraffes have no vocal cords"],
        ["text" => "Did you know most birds eat twice their body weight each day"],
        ["text" => "Did you know a group of whales is called a pod"],
        ["text" => "Did you know armadillos can walk underwater"],
        ["text" => "Did you know the bones of a pigeon weigh less than its feathers"],
        ["text" => "Did you know the cheetah is the only cat that can't retract it's claws"],
        ["text" => "Did you know roosters can't crow if they can't fully extend their necks"],
        ["text" => "Did you know dolphins can hear underwater sounds from 24km (15miles) away"],
        ["text" => "Did you know flamingos can only eat when their heada are upside down"],
        ["text" => "Did you know the fingerprints of koala bear are indistinguishable to that of a human"],
        ["text" => "Did you know a female ferret is called a jill"],
        ["text" => "Did you know porcupines float in water"],
        ["text" => "Did you know the last Play Boy centerfold to have staples was published in 1985"],
        ["text" => "Did you know Scissors were most likely invented ancient Egypt"],
        ["text" => "Did you know each year there is one ton of cement poured for each man, woman, and child"],
        ["text" => "Did you know turnips turn green when sunburnt"],
        ["text" => "Did you know The US shreds 7,000 tons of worn out currency each year"],
        ["text" => "Did you know moisture (not air) causes super glue to dry"],
        ["text" => "Did you know americans spend $10 million a day on potato chips"],
        ["text" => "Did you know Neil Armstrong once threatened to sue his barber for selling his hair?"],
        ["text" => "Did you know your liver's size fluctuates significantly throughout the day?"],
        ["text" => "Did you know there are actually two Air Force Ones?"],
        ["text" => "Did you know actor Daniel Radcliffe went through nearly 70 wands and 160 pairs of glasses during the making of the Harry Potter films?"],
        ["text" => "Did you know the filling in Kit Kats is made from NG Kit Kats?"],
        ["text" => "Did you know Loch Ness contains more freshwater than all of England's lakes combined?"],
        ["text" => "Did you know there's a 50,000-word novel without the letter 'E'? "],
        ["text" => "Did you know before 1920, some people used to send children in the mail?"],
        ["text" => "Did you know blinking could serve as mental rest, not eye lubrication?"],
        ["text" => "Did you know goats have emotional intelligence? "],
        ]);
    }
}