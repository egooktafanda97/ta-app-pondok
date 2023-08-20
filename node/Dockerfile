# Menggunakan image node.js 16 sebagai base image
FROM node:16

# Set working directory di dalam container
WORKDIR /app

# Copy package.json dan package-lock.json (jika ada) ke dalam container
COPY package*.json ./

# Install dependencies menggunakan npm
RUN npm install

# Copy seluruh kode aplikasi ke dalam container
COPY . .

# Build aplikasi Typescript
RUN npm run build

# Install PM2 secara global di dalam container
RUN npm install pm2 -g

# Expose port 5016 untuk PM2
EXPOSE 5040

# Jalankan aplikasi menggunakan PM2
CMD ["pm2-runtime", "dist/server.js"]
