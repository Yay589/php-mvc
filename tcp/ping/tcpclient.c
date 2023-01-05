#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <sys/types.h>          
#include <sys/socket.h>
#include <netinet/in.h>
#include <netinet/ip.h> 
#include <arpa/inet.h>
#include <string.h>

#define PORT 1234
#define IP "127.0.0.1"
#define BUF_SIZE 1024


void stop(char *msg){
    perror(msg);
    exit(EXIT_FAILURE);
}

int main(int argc, char** argv){
    
    int sockfd = socket(AF_INET, SOCK_STREAM, 0);
    
    if ( sockfd == -1 )
        stop("socket");
    
    struct sockaddr_in serv_addr;
    bzero(&serv_addr, sizeof(serv_addr));

    //fill the sockaddr_in structure
    inet_pton( AF_INET, IP , &serv_addr.sin_addr);
    serv_addr.sin_family = AF_INET;
    serv_addr.sin_port = htons(PORT);


    if ( connect(sockfd, (struct sockaddr*)&serv_addr, (socklen_t) sizeof(serv_addr)) == -1){
        close(sockfd);
        stop("connect");
    }

    int n=-1;
    char buffer[BUF_SIZE+1];
    char * msg= "ECHO";
    for (int i=0; i<1000; i++){

        if ( send(sockfd, msg, strlen(msg), 0) == -1){
            close(sockfd);
            stop("send");
        }

        n = recv( sockfd, buffer, BUF_SIZE, 0 );
        if ( n == -1){
            close(sockfd);
            stop("recv");
        }
        
        buffer[n]='\0';
        printf("%s\n", buffer);
        
        if (n == 0){
            // client finish to send
            break;
        }
    

    }
    
    puts("ok");
    close(sockfd);
    return 0;
}