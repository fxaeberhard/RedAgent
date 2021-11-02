FROM  node:8

WORKDIR /app

# Install app dependencies
# A wildcard is used to ensure both package.json AND package-lock.json are copied where available (npm@5+)
COPY package*.json ./
RUN npm install
RUN npm i -g bower gulp svgo
COPY bower.json ./
RUN bower install --allow-root

COPY . .

