# Joe's Notes

- No additional running steps should be required beyond those outlined in 01-local-development-setup.md

- I have added an additional user to the database seeder for the purposes of demonstrating sales-agent tracking. 
You won't need to log into it.

- I have added a seeder to populate 20 dummy sales for the purposes of the demo. They will populate as part of the usual `php artisan migrate:fresh --seed`

- I noticed that there is hints in the code of what appears to be a Part 3? Related to shipping providers. My test spec document only requested Parts 1 and 2
I have run with the assumption that Part 3 was removed at somepoint!

- I have built the app using Livewire, it seemed like an obvious choice for this. Below are the paths to some of the most relevant files:
	- /app/Livewire - Component Classes
	- /resources/views/livewire - Component Views
	- /tests/Feature/Livewire - Tests