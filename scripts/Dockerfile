FROM php:7.4-cli

# Install Faker library
RUN apt-get update && apt-get install -y git \
    && git clone https://github.com/fzaninotto/Faker.git \
    && mv Faker/src /faker \
    && rm -rf Faker

# Copy PHP script
COPY script.php /app/script.php

# Set working directory
WORKDIR /app

# Run PHP script
CMD ["php", "script.php"]
