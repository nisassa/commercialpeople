# commercialpeople_tech_test

<h3>Installation Instructions</h3>
<p>
1. Clone or download the repository: <code>clone git@github.com:nisassa/commercialpeople.git</code> (or <code>clone https://github.com/nisassa/commercialpeople.git</code>)<br/>
<br/>2. Edit the .env file, add in your database URL: DATABASE_URL=mysql://DB_USER:DB_PASS@DB_HOST:DB_PORT/thetest
3. Run <code>composer install</code><br/>
4. Run the command to create the database: <code>php bin/console doctrine:database:create</code><br/>
5. Execute the migration files: <code>php bin/console doctrine:migrations:migrate</code><br/>
5. Load DataFixtures: <code>php bin/console doctrine:fixtures:load</code><br/>
5. Start your local server: <code>php bin/console server:start</code><br/>
</p>
<h3>Documentation</h3>
<p>This applications is using the <a href="https://github.com/lexik/LexikJWTAuthenticationBundle">LexikJWTAuthenticationBundle</a> that provide us with JWT (Json Web Token) authentication.
</p>
<h5>Register new user</h5>
<p><code>curl -X POST http://localhost:8000/register -d _username=YourUserName -d _password=YourPassword</code></p>
<h5>Get a JWT Token</h5>
<p><code>curl -X POST -H "Content-Type: application/json" http://localhost:8000/login_check -d '{"username":"YourUserName","password":"YourPassword"}'</code></p>
<H4>Api Endpoints</H4>
 <p>The following API endpoints are available whithin the Application:
   <OL>
     <li><code>/api/league/{id}/teams</code> - Get a list of football teams in given league</li>       
     <li><code>/api/new/team</code> - Create a football team</li>      
     <li><code>/api/update/team/{id}</code> - Replace all attributes of a football team</li>              
     <li><code>/api/league/{id}/delete</code> - Delete a football league</li>
    </OL>
  </p>
<h4>Run Unit Tests</h4>
<p><code> php bin/phpunit</code></p>
